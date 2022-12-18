<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTable;
use App\Http\Requests\roles\{
    storeRequest as roleStoreRequest,
    updateRequest as roleUpdateRequest
};
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Services\Interfaces\{
    RoleTypesInterface
};

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $dataTable)
    {
        // sleep(2);
        $roles = (new Role())->inRandomOrder()->limit(5)->get();
        return $dataTable->render('admin.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!request()->ajax()) {

            $data = [
                'roles' => $this->RoleTypesInterface->getAllWithTree(),
            ];
            return view('app.roles.create',$data);
        } else {
            abort(403);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(roleStoreRequest $request)
    {
        try {
            $record = (new Role())->create([
                'name' => $request->role_name,
                'guard_name' => $request->guard_name,
                'parent_id' => $request->parent_id,
            ]);

            if ($request->default) {
                $record = $this->makeDefaultRole($record->id);
                // dd($record);
            }

            return redirect()->route('roles.index')->withSuccess(__('lang.commons.data_saved'));
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $role = (new Role())->find(decryptParams($id));

            if ($role && !empty($role)) {
                $data = [
                    'roles' => $this->RoleTypesInterface->getAllWithTree(),
                    'role' => $role,
                ];

                return view('app.roles.edit', $data);
            }

            return redirect()->route('roles.index')->withWarning(__('lang.commons.data_not_found'));
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(roleUpdateRequest $request, $id)
    {
        try {
            $record = (new Role())->where('id', decryptParams($id))->update([
                'name' => $request->role_name,
                'guard_name' => $request->guard_name,
                'parent_id' => $request->parent_id,
            ]);

            if ($request->default) {
                $record = $this->makeDefaultRole($record->id);
            }

            return redirect()->route('roles.index')->withSuccess(__('lang.commons.data_saved'));
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $record = (new Role())->find(decryptParams($id));

            if ($record && !empty($record)) {
                $record->delete();

                if ($record->default) {
                    $firstRecord = (new Role())->first();
                    $record = $this->makeDefaultRole($firstRecord->id);
                }

                return redirect()->route('roles.index')->withSuccess(__('lang.commons.data_deleted'));
            }

            return redirect()->route('roles.index')->withWarning(__('lang.commons.data_not_found'));
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    public function makeDefault(Request $request, $id)
    {
        try {
            $record = (new Role())->find(decryptParams($id));

            if ($record && !empty($record)) {
                $record = $this->makeDefaultRole($record->id);
                return redirect()->route('roles.index')->withSuccess(__('lang.commons.made_default'));
            }

            return redirect()->route('roles.index')->withWarning(__('lang.commons.data_not_found'));
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    public function makeDefaultRole($id)
    {
        $record = (new Role())->where('id', '>', 0)->update([
            'default' => 0,
        ]);
        try {

            $record = (new Role())->where('id', $id)->update([
                'default' => 1,
            ]);

            return 1;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function destroySelected(Request $request)
    {
        try {
            if ($request->has('chkRole')) {

                (new Role())->whereIn('id', $request->chkRole)->delete();

                $record = (new Role())->where('default', 1)->first();
                if (is_null($record) || empty($record)) {
                    $firstRecord = (new Role())->first();
                    $record = $this->makeDefaultRole($firstRecord->id);
                }
                return redirect()->route('roles.index')->withSuccess(__('lang.commons.data_deleted'));
            } else {
                return redirect()->route('roles.index')->withWarning(__('lang.commons.please_select_at_least_one_item'));
            }
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }
}
