<template>
  <div>
    <CRow>
      <CCol>
        <h3>2 Export Report</h3>
      </CCol>
    </CRow>
    <CRow>
      <CCol>
        <CButton color="info" @click="exportData" v-if="!status" :disabled="status">Export</CButton>
        <CButton color="info" v-if="status" :disabled="status">
          <CSpinner component="span" size="sm" aria-hidden="true"/>Loading...
        </CButton>
      </CCol>
    </CRow>
  </div>
</template>
<script>
import { exportData } from "../../helpers/smoker";
export default {
  name: "Users",
  data() {
    return {
      caption: "2 Export Report",
      status: false
    };
  },
  mounted() {},
  watch: {},
  metaInfo() {
    return {
      title: "2 Export Report",
    };
  },
  methods: {
    exportData() {
      this.status = true
      exportData().then((res)=>{
          // this.status = false
      }).catch((err) => {
          console.log(err)
        }).finally(() => this.status = false)
    },
  },
};
</script>