<template>
  <div>
    <CRow>
      <CCol sm="12">
        <CCard>
          <CCardHeader>
            <CRow>
              <CCol>
                <h3>1.1 User Survey Status</h3>
              </CCol>
            </CRow>
            <CForm inline>
              <CRow class="align-items-center">
                <CInput
                  class="ml-2"
                  v-model="query.account_id"
                  placeholder="User ID"
                >
                </CInput>
                <CSelect
                  class="ml-2"
                  horizontal
                  :value.sync="query.sort"
                  :options="form.sort"
                  placeholder="Please select"
                />
                <CCol col="4" sm="4" md="2" xl>
                  <CButton block color="info" @click="getList">Search</CButton>
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
              <template #account_id="{ item }">
                <td>{{ item.account_id }}</td>
              </template>
              <template #date="{ item }">
                <td>{{ item.date | moment("YYYY-MM-DD") }}</td>
              </template>
              <template #nth_day_current="{ item }">
                <td>{{ item.nth_day_current }}</td>
              </template>
              <template #ema_1="{ item }">
                <td>{{ item.ema_1 }}</td>
              </template>
              <template #ema_2="{ item }">
                <td>{{ item.ema_2 }}</td>
              </template>
              <template #ema_3="{ item }">
                <td>{{ item.ema_3 }}</td>
              </template>
              <template #valid_ema="{ item }">
                <td>{{ item.valid_ema }}</td>
              </template>
              <template #incentive="{ item }">
                <td>{{ item.incentive }}</td>
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
import { incentiveList } from "../../helpers/incentive";
export default {
  name: "Users",
  data() {
    return {
      last_page: 1,
      query: {
        account_id: undefined,
        page: 1,
        size: 20,
        sort: "account_id,desc",
      },
      caption: "Users",
      fields: [
        { key: "account_id", label: "account_id" },
        { key: "date", label: "date" },
        { key: "nth_day_current", label: "nth_day_current" },
        { key: "ema_1", label: "ema_1" },
        { key: "ema_2", label: "ema_2" },
        { key: "ema_3", label: "ema_3" },
        { key: "valid_ema", label: "valid_ema" },
        { key: "incentive", label: "incentive" },
      ],
      items: [],
      form: {
        sort: [
          {
            value: "account_id,desc",
            label: "Default",
          },
          {
            value: "date,desc",
            label: "IDs grouped",
          },
        ],
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
      title: "User Survey Status",
    };
  },
  methods: {
    getList() {
      incentiveList(this.query)
        .then((res) => {
          this.items = res.data;
          this.last_page = res.last_page;
        })
        .catch((err) => {
          console.log(err);
        });
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