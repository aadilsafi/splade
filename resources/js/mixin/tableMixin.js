export default {
    created()
    {
        this.get();
    },
    watch: {
        filters: {
            handler(data) {
                this.get()
            },
            deep: true
        },
        paginator: {
            handler(data)
            {
                this.get()
            },
            deep:true
        },
        _page(_new, _old) {
            this.get();
        },
        _sortBy(_new, _old) {
            this.get();
        },
        _descending(_new, _old) {
            this.get();
        },
        _paginator() {
            return {
                page: this.paginator.page,
                sortBy: this.paginator.sortBy,
                descending: this.paginator.descending,
            }
        }
        

    },
    methods: {
        paginate()
        {
            this.get();
        },
        get() {
            return new Promise((resolve, reject) => {
                axios.get(this.endpoints.index, {
                    params: {
                        ...this._paginator,
                        ...this.filters
                    }
                })
                    .then((response) => {
                        console.log(response)
                        this.api.items = response.data.data;
                        // this.paginator.page === 1 || this.type === 'pagination' ? this.api.items = [] : null;
                        // Object.keys(this.api).forEach((key) =>
                        //   this.api[key] = (key === 'items') ? [...this.api.items, ...response.data.paginator.data] : response.data[key]);
                        
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    })
                    .finally(() => {
                        // this.$q.loading.hide();
                        // this.loading = false;
                    })
                ;
            });
        },
    }
}
