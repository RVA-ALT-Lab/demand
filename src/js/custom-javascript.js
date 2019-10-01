// Add your custom JS here.

var blogURL = '/wp-content/themes/demand/data/database.json'

var blog = new Vue({

  el: '#heurist',
  data: function() {
    return {
      records: [],
      database: {},
      typeFacets: [],
      selectedRecordType: '',
      selectedDetail: '',
      details: {}
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
    },
    selectedRecords() {
      console.log('being evaluated')
      return this.mappedRecords.filter(record => {
        return record.rec_RecTypeName === this.selectedRecordType
      })
    },
    selectedRecordDetails() {
      const details = {}
      for (const record of this.selectedRecords){
        for(const detail of record.details) {
          if(!details[detail.fieldName]) {
            details[detail.fieldName] = {
              fieldName: detail.fieldName,
              fieldType: detail.fieldType
            }
          }
        }
      }
      return Object.values(details)
    },
    selectedDetailValues() {
      return this.selectedRecords.map(record => {
        const details = record.details.filter(detail => detail.fieldName === this.selectedDetail)
        if (details[0]){
          return details[0].value
        }
      })
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