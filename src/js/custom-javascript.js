// Add your custom JS here.

var blogURL = '/wp-content/themes/demand/data/database.json'

var blog = new Vue({

  el: '#heurist',
  data: function() {
    return {
      records: [],
      database: {},
      selectedRecordType: '',
      selectedDetail: '',
      searchTerm: '',
      foundRecords: [],
      isSearching: false
    }
  },
  computed: {
    mappedRecords() {
      return this.records.map(record => {
        record.rec_RecType = this.database.rectypes[record.rec_RecTypeID]
        return record
      })
    },
    selectedRecords() {
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
    }
  },
  mounted() {
    this.fetchData()
  },

  methods: {
    searchBasedOnTerm() {
      this.isSearching = true
      const foundRecords = this.selectedRecords.filter(record => {
        const foundDetails = record.details.filter(detail => {
          console.log(detail)
          if (detail.fieldType === 'resource'){
            if (detail.value.title.toLowerCase().includes(this.searchTerm.toLowerCase())) {
              return true
            }
          } else {
            if (detail.value.toLowerCase().includes(this.searchTerm.toLowerCase())) {
              return true
            }
          }
        })

        if (foundDetails.length > 0) {
          return true
        }
      })
      this.isSearching = false
      this.foundRecords = foundRecords
    },
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