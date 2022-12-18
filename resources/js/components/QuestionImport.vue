<template>
  <div>
    <template>
        <!-- <v-btn @click="testFunction">Search</v-btn>
        <v-btn @click="rating">Rating</v-btn> -->
        
        <v-data-table
            :headers="defaultColumns"
            :items="api.items"
            :items-per-page="5"
            class="elevation-1"
           item-key="id" 
           show-select
        >
          
           <template v-slot:item.answers="{ item }">
            <v-chip
              :color="key == 0 ? 'green' : 'red'"
              dark
             v-for="(answer,key) in item.answers.split(',')"
             :key="key"
            >
              {{ answer }}
            </v-chip>
          </template>
           <template v-slot:item.category="{ item }">
            {{item.category.name}}
          </template>
          <template v-slot:item.bank="{ item }">
            {{item.bank.name}}
          </template>
        </v-data-table>
    </template>
  </div>
</template>
    
<script>
import axios from 'axios'
import tableListMixin from '../mixin/tableMixin'
export default {
  mixins: [tableListMixin],
  methods:{
    
    testFunction()
    {
      if(this.filters.search == null)
        this.filters.search = 'Testing';
      else
        this.filters.search = null;
      
    },
    rating()
    {
      if(this.filters.rating == null)
        this.filters.rating = 3;
      else
        this.filters.rating = null
    }
  },
  
  data() {
    return {
         name:'',
         api: {
            items: [],
          },
         paginator: {
            sortBy: 'created_at',
            descending: true,
            page: 1,
            rowsNumber: -1,
            totalPages: 0
        },
         filters: {
          search: null,
          rating: null
      },
      items: [{ title: "Dashboard" }, { title: "Account" }, { title: "Admin" }],
      defaultColumns: [
          {
            text: 'Id',
            align: 'start',
            sortable: false,
            value: 'id',
          },
          {
            text: 'Question',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'Category', value: 'category' },
          { text: 'Bank', value: 'bank' },
          { text: 'Answers', value: 'answers' },
        ]
        
      
    }
  },
  computed: {
    endpoints() {
      return {
        index: 'api/imported-questions',
      }
    }
  },
};
</script>
<style scoped>
</style>