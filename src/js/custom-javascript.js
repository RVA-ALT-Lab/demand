// Add your custom JS here.

var blogURL = '/wp-content/themes/demand/data/database.json'

var blog = new Vue({

  el: '#heurist',
  data: function() {
    return {
      records: [],
      database: {},
      typeFacets: []
    }
  },
  computed: {
    mappedRecords() {
      return this.records.map(record => {
        record.rec_RecType = this.database.rectypes[record.rec_RecTypeID]
        return record
      })
    },
    filteredRecords() {
      if (this.typeFacets.length === 0) {
        return this.mappedRecords
      } else {
        var filteredSets = this.mappedRecords.filter(record => {
          return this.typeFacets.includes(record.rec_RecType.name)
        })
        return filteredSets
      }
    }
  },
  mounted() {
    this.fetchData()
  },

  methods: {
    fetchData() {
      var xhr = new XMLHttpRequest()
      xhr.open('GET', blogURL)
      xhr.onload = () => {
        var json = JSON.parse(xhr.responseText)
        console.log(json)
        this.records = json.heurist.records;
        this.database = json.heurist.database
      }
      xhr.send()
    }
  }
})