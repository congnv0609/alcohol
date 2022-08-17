<template>
  <div class="c-app flex-row align-items-center">
    <CContainer>
      <CRow class="justify-content-center">
        <CCol md="8">
          <CAlert
            color="danger"
            dismissible
            closeButton
            :show.sync="alert"
            >Email or Password is incorrect!</CAlert
          >
          <CCardGroup>
            <CCard class="p-4">
              <CCardBody>
                <CForm @submit.prevent="submit">
                  <h1>Login</h1>
                  <p class="text-muted">Sign in to your account</p>
                  <CInput
                    placeholder="Username"
                    type="text"
                    autocomplete="username"
                    v-model="form.email"
                  >
                    <template #prepend-content
                      ><CIcon name="cil-user"
                    /></template>
                  </CInput>
                  <CInput
                    placeholder="Password"
                    type="password"
                    autocomplete="curent-password"
                    v-model="form.password"
                  >
                    <template #prepend-content
                      ><CIcon name="cil-lock-locked"
                    /></template>
                  </CInput>
                  <CRow>
                    <CCol col="6" class="text-left">
                      <CButton color="primary" class="px-4" type="submit"
                        >Login</CButton
                      >
                    </CCol>
                    <!-- <CCol col="6" class="text-right">
                      <CButton color="link" class="px-0"
                        >Forgot password?</CButton
                      >
                    </CCol> -->
                  </CRow>
                </CForm>
              </CCardBody>
            </CCard>
          </CCardGroup>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>

<script>
import { login } from "../../helpers/auth";
export default {
  name: "Login",
  data() {
    return {
      alert: false,
      form: {
        email: "",
        password: "",
      },
    };
  },
  mounted: function () {},
  computed: {
    authError() {
      return this.$store.getters.AUTH_ERROR;
    },
  },
  methods: {
    submit: function () {
      this.$store.dispatch("LOGIN");
      login(this.form)
        .then((res) => {
          this.$store.commit("LOGIN_SUCCESS", res);
          this.$router.push({ path: "/" });
        })
        .catch((err) => {
          this.$store.commit("LOGIN_FAILED", { err });
          this.alert = true;
        });
    },
  },
};
</script>
