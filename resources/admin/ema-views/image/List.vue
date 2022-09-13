<template>
  <div>
    <CRow>
      <CCol sm="12">
        <CCard>
          <CCardHeader>
            <CRow>
              <CCol>
                <h3>1.2 Images</h3>
              </CCol>
            </CRow>
            <CForm inline>
              <CRow class="align-items-center">
                <CInput
                  class="ml-2"
                  v-model="query.account"
                  placeholder="User ID"
                >
                </CInput>
                <CInput
                  class="ml-2"
                  v-model="query.photo_name"
                  placeholder="File name"
                />
                <CCol>
                  <CButton color="info" @click="getList">Search</CButton>
                  <CButton color="info" @click="getList">Download Image</CButton>
                </CCol>
              </CRow>
            </CForm>
          </CCardHeader>
          <CCardBody>
            <CDataTable
              :striped="true"
              :small="false"
              :items="items"
              :fields="fields"
              :items-per-page="query.size"
            >
              <template #user_id="{ item }">
                <td>{{ item.account }}</td>
              </template>
              <template #file_name="{ item }">
                <td>{{ item.photo_name }}</td>
              </template>
              <template #image="{ item }">
                <td>
                  <img :src="item.small_url" width="64px" class="img-fluid" alt="Responsive image">
                </td>
              </template>
              <template #all>
                <td>
                </td>
              </template>
            </CDataTable>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
    <CRow>
      <CCol sm="12">
        <CPagination :active-page.sync="query.page" :pages="last_page" />
      </CCol>
    </CRow>
  </div>
</template>
<script>
import { list } from "../../helpers/image";
export default {
  name: "Images",
  data() {
    return {
      last_page: 1,
      query: {
        account: undefined,
        page: 1,
        size: 20,
      },
      caption: "Images",
      fields: [
        { key: "user_id", label: "user_id" },
        { key: "file_name", label: "File name" },
        { key: "image", label: "Image" },
        { key: "all", label: "All" },
      ],
      items: [],
      form: {
      },
    };
  },
  mounted() {
    this.getList();
  },
  watch: {
    "query.page": function (val, oldVal) {
      return this.getList();
    },
  },
  metaInfo() {
    return {
      title: "Images",
    };
  },
  methods: {
    getList() {
      list(this.query)
        .then((res) => {
          this.items = res.data;
          this.last_page = res.last_page;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    editRow(id) {
      this.$router.push({ path: `/smokers/edit/${id}` });
    },
    deleteRow(id) {
      console.log("delete", id);
    },
    overview(id) {
      this.$router.push({ path: `/smokers/overview/${id}` });
    },
  },
};
</script>
<style scoped>
.light-red-color {
  color: palevioletred;
}
.text-bold {
  font-weight: bold;
}
</style>