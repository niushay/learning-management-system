<script setup lang="ts">
import Form from 'vform'
import AuthProvider from '@/views/pages/authentication/AuthProvider.vue'
import logo from '@images/logo.svg?raw'

const vue_router = useRouter();

const form = ref(new Form({
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
  privacyPolicies: false,
}))

const errors = ref(null)
const isPasswordVisible = ref(false)
const isPasswordConfirmationVisible = ref(false)

const register = async () => {
  form.value.post(route('auth.register'))
    .then(() => {
      vue_router.push('/')
    })
    .catch(e => {
      errors.value = e.response.data.errors
      console.error(errors.value)
    })
}
</script>

<template>
  <div class="auth-wrapper d-flex align-center justify-center pa-4">
    <VCard
      class="auth-card pa-4 pt-7"
      max-width="448"
    >
      <VCardItem class="justify-center">
        <template #prepend>
          <div class="d-flex">
            <div
              class="d-flex text-primary"
              v-html="logo"
            />
          </div>
        </template>

        <VCardTitle class="text-2xl font-weight-bold">
          Learning Management System
        </VCardTitle>
      </VCardItem>

      <VCardText class="pt-2">
        <p class="mb-0">
          manage your system easy!
        </p>
      </VCardText>
      <VCardText class="pt-2 text-error">
        <div v-for="(errorMessages, field) in errors" :key="field">
          <ul>
            <li v-for="(error, index) in errorMessages" :key="index">
              {{ error }}
            </li>
          </ul>
        </div>
      </VCardText>

      <VCardText>
        <VForm
            @submit.prevent="register"
          @keydown="form.onKeydown($event)">
          <VRow>
            <!-- Username -->
            <VCol cols="12">
              <VTextField
                v-model="form.username"
                autofocus
                label="Username"
                placeholder="admin"
              />
            </VCol>
            <!-- email -->
            <VCol cols="12">
              <VTextField
                v-model="form.email"
                label="Email"
                placeholder="admin@email.com"
                type="email"
              />
            </VCol>

            <!-- password -->
            <VCol cols="12">
              <VTextField
                v-model="form.password"
                label="Password"
                placeholder="············"
                :type="isPasswordVisible ? 'text' : 'password'"
                :append-inner-icon="isPasswordVisible ? 'bx-hide' : 'bx-show'"
                @click:append-inner="isPasswordVisible = !isPasswordVisible"
              />
            </VCol>
            <VCol cols="12">
              <VTextField
                v-model="form.password_confirmation"
                label="Password Confirmation"
                placeholder="············"
                :type="isPasswordConfirmationVisible ? 'text' : 'password'"
                :append-inner-icon="isPasswordConfirmationVisible ? 'bx-hide' : 'bx-show'"
                @click:append-inner="isPasswordConfirmationVisible = !isPasswordConfirmationVisible"
              />
              <div class="d-flex align-center mt-1 mb-4">
                <VCheckbox
                  id="privacy-policy"
                  v-model="form.privacyPolicies"
                  inline
                />
                <VLabel
                  for="privacy-policy"
                  style="opacity: 1;"
                >
                  <span class="me-1">I agree to</span>
                  <a
                    href="javascript:void(0)"
                    class="text-primary"
                  >privacy policy & terms</a>
                </VLabel>
              </div>

              <VBtn
                block
                type="submit"
              >
                Sign up
              </VBtn>
            </VCol>


            <!-- login instead -->
            <VCol
              cols="12"
              class="text-center text-base"
            >
              <span>Already have an account?</span>
              <RouterLink
                class="text-primary ms-2"
                to="/login"
              >
                Sign in instead
              </RouterLink>
            </VCol>

            <VCol
              cols="12"
              class="d-flex align-center"
            >
              <VDivider />
              <span class="mx-4">or</span>
              <VDivider />
            </VCol>

            <!-- auth providers -->
            <VCol
              cols="12"
              class="text-center"
            >
              <AuthProvider />
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </div>
</template>

<style lang="scss">
@use "@core-scss/template/pages/page-auth.scss";
</style>
