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
                  v-model="query.account"
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
              <template #user_id="{ item }">
                <td>{{ item.account }}</br><CButton v-if="item.status" color="danger" @click="deleteUser(item.id)" variant="ghost">(Delete)</CButton></td>
              </template>
              <template #start_date="{ item }">
                <td>{{ item.start_date | moment("YYYY-MM-DD") }}</td>
              </template>
              <template #end_date="{ item }">
                <td>{{ item.end_date | moment("YYYY-MM-DD") }}</td>
              </template>
              <template #nth_day_current="{ item }">
                <td
                  v-if="
                    item.nth_day_current <= 3 && item.ema_completed_nth_day < 3
                  "
                  class="text-danger text-bold"
                >
                  {{ item.nth_day_current }}
                </td>
                <td
                  v-if="
                    item.nth_day_current > 3 && item.ema_completed_nth_day < 3
                  "
                  class="light-red-color"
                >
                  {{ item.nth_day_current }}
                </td>
                <td v-if="item.ema_completed_nth_day >= 3">
                  {{ item.nth_day_current }}
                </td>
              </template>
              <template #ema_completed_nth_day="{ item }">
                <td
                  v-if="
                    item.nth_day_current <= 3 && item.ema_completed_nth_day < 3
                  "
                  class="text-danger text-bold"
                >
                  {{ item.ema_completed_nth_day }}
                </td>
                <td
                  v-if="
                    item.nth_day_current > 3 && item.ema_completed_nth_day < 3
                  "
                  class="light-red-color"
                >
                  {{ item.ema_completed_nth_day }}
                </td>
                <td v-if="item.ema_completed_nth_day >= 3">
                  {{ item.ema_completed_nth_day }}
                </td>
              </template>
              <template #incentive_nth_day="{ item }">
                <td>{{ item.incentive_nth_day }}</td>
              </template>
              <template #incentive_total="{ item }">
                <td>{{ item.incentive_total }}</td>
              </template>
              <template #action="{ item }">
                <td>
                  <CButton block color="info" @click="overview(item.account_id)"
                    >Personal Overview Description</CButton
                  >
                  <CButton block color="info" @click="exportData(item.account_id)"
                    >EMA Record Export</CButton
                  >
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
    <CModal
      title="Delete account forever"
      color="danger"
      size="sm"
      :centered="alert.centered"
      :show.sync="alert.show"
      @update:show = "closeModal"
    >
      Your action cannot recover
    </CModal>
  </div>
</template>
<script>
import { smokers, exportPersonal, deleteAccount } from "../../helpers/smoker";
export default {
  name: "Users",
  data() {
    return {
      alert: {
        show: false,
        centered: true,
        accountId: undefined
      },
      last_page: 1,
      query: {
        account: undefined,
        page: 1,
        size: 21,
        sort: "updated_at,desc",
      },
      caption: "Users",
      fields: [
        { key: "user_id", label: "user_id" },
        { key: "start_date", label: "start_date" },
        { key: "end_date", label: "end_date" },
        { key: "nth_day_current", label: "nth_day_current" },
        { key: "ema_completed_nth_day", label: "ema_completed_nth_day" },
        { key: "incentive_nth_day", label: "incentive_nth_day" },
        { key: "incentive_total", label: "incentive_total" },
        "action",
      ],
      items: [],
      form: {
        sort: [
          {
            value: "updated_at,desc",
            label: "Default",
          },
          {
            value: "start_date,desc",
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
    deleteUser(id){
      this.alert.show = true;
      this.alert.accountId = id;
      // deleteAccount(id).then(result=>{
      //   this.getList(this.query);
      // });
    },
    closeModal(status, evt, accept) { 
      if (accept) {
        if(this.alert.accountId !== undefined) {
          deleteAccount(this.alert.accountId).then(result=>{
            this.getList(this.query);
          });
        }
      } 
    },
    getList() {
      smokers(this.query)
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
    exportData(id) {
      exportPersonal(id);
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