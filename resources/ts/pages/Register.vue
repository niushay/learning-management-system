<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3'
import BlankLayout from '../layouts/blank.vue'
import AuthProvider from '@/views/pages/authentication/AuthProvider.vue'
import logo from '@images/logo.svg?raw'

defineProps({ errors: Object })

const isPasswordVisible = ref(false)
const isPasswordConfirmationVisible = ref(false)

const form = reactive({
  username: null,
  email: null,
  password: null,
  password_confirmation: null,
  privacyPolicies: false,
})

async function register() {
  router.post('/register', form)
}

const emailRules = [
  (v: string) => !!v || 'Email is required',
  (v: string) => /.+@.+\..+/.test(v) || 'Enter a valid email address',
]

const passwordRules = [
  (v: string) => !!v || 'Password is required',
]

const usernameRules = [
  (v: string) => !!v || 'Username is required',
]
</script>

<template>
  <BlankLayout>
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
            Learning Platform
          </VCardTitle>
        </VCardItem>
        <VCardText class="pt-2">
          <p class="mb-0">
            manage your system easy!
          </p>
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
                  autofocus="true"
                  label="Username"
                  placeholder="John"
                  :rules="usernameRules"
                />
              </VCol>
              <!-- email -->
              <VCol cols="12">
                <VTextField
                  v-model="form.email"
                  label="Email"
                  placeholder="john@gmail.com"
                  type="email"
                  :error-messages="errors?.email"
                  :rules="emailRules"
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
                  :error-messages="errors?.password"
                  :rules="passwordRules"
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
                  :rules="passwordRules"
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
                <Link
                  class="text-primary ms-2"
                  href="/login"
                >
                  Sign in instead
                </Link>
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
  </BlankLayout>
</template>

<style lang="scss">
@use "@core-scss/template/pages/page-auth.scss";
</style>
