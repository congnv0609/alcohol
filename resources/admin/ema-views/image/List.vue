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
            <CRow>
              <CCol>
                <CButton color="info" @click="download">Download Image</CButton>
              </CCol>
            </CRow>
            <!-- <CForm inline>
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
                  <CButton color="info" @click="download">Download Image</CButton>
                </CCol>
              </CRow>
            </CForm> -->
          </CCardHeader>
          <!-- <CCardBody>
            <CDataTable
              :striped="true"
              :small="false"
              :items="items"
              :fields="fields"
              :items-per-page="query.size"
              @row-clicked="rowClicked"
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
              <template #select-header>
                <CInputCheckbox
                  @update:checked="(e) => checkAll(e)"
                  custom
                  label="All"
                />
              </template>
              <template #select="{ item }">
                <td>
                  <CInputCheckbox
                    :checked="item._selected"
                    @update:checked="() => check(item)"
                    custom
                  />
                </td>
              </template>
            </CDataTable>
          </CCardBody> -->
        </CCard>
      </CCol>
    </CRow>
    <!-- <CRow>
      <CCol sm="12">
        <CPagination :active-page.sync="query.page" :pages="last_page" />
      </CCol>
    </CRow> -->
  </div>
</template>
<script>
import { list, download } from "../../helpers/image";
export default {
  name: "Images",
  data() {
    return {
      last_page: 1,
      query: {
        account: undefined,
        photo_name: undefined,
        page: 1,
        size: 20,
      },
      caption: "Images",
      fields: [
        { key: "user_id", label: "user_id" },
        { key: "file_name", label: "File name" },
        { key: "image", label: "Image" },
        { key: "select", label: "", _style: "min-width:1%", sorter: false, filter: false, },
      ],
      items: [],
      form: {
      },
      accountId: [],
    };
  },
  mounted() {
    // this.getList();
  },
  watch: {
    // "query.page": function (val, oldVal) {
    //   return this.getList();
    // },
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
    download(){
      this.getArrayAccount();
      download({array_id: this.accountId}).then((res)=>{

      });
    },
    rowClicked(item, index, column, e) {
      if (!["INPUT", "LABEL"].includes(e.target.tagName)) {
        this.check(item);
      }
    },
    check(item) {
      const val = Boolean(item._selected);
      this.$set(item, "_selected", !val);
    },
    checkAll(checked) {
      this.items.forEach((item) => {
        this.$set(item, "_selected", checked);
      });
    },
    getArrayAccount() {
      this.accountId = [];
      this.items.forEach((item)=>{
        if(item._selected) {
          this.accountId.push(item.id);
        }
      })
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