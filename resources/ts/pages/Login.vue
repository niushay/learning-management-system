<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3'
import { reactive } from 'vue'
import BlankLayout from '../layouts/blank.vue'
import AuthProvider from '@/views/pages/authentication/AuthProvider.vue'
import logo from '@images/logo.svg?raw'

defineProps({ errors: Object })

const isPasswordVisible = ref(false)

const form = reactive({
  email: null,
  password: null,
  remember: false,
})

async function submit() {
  router.post('/login', form)
}

const emailRules = [
  (v: string) => !!v || 'Email is required',
  (v: string) => /.+@.+\..+/.test(v) || 'Enter a valid email address',
]

const passwordRules = [
  (v: string) => !!v || 'Password is required',
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
          <h5 class="text-h5 mb-1">
            Welcome to Learning Platform!
          </h5>
          <p class="mb-0">
            Please sign-in to your account and start the adventure
          </p>
        </VCardText>
        <VCardText>
          <VForm @submit.prevent="submit">
            <VRow>
              <!-- email -->
              <VCol cols="12">
                <VTextField
                  v-model="form.email"
                  autocapitalize="off"
                  placeholder="johndoe@email.com"
                  label="Email"
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
                <!-- remember me checkbox -->
                <div class="d-flex align-center justify-space-between flex-wrap mt-1 mb-4">
                  <VCheckbox
                    v-model="form.remember"
                    label="Remember me"
                  />

                  <Link
                    class="text-primary ms-2 mb-1"
                    href="#"
                  >
                    Forgot Password?
                  </Link>
                </div>

                <!-- login button -->
                <VBtn
                  block
                  type="submit"
                  :disabled="form.processing"
                >
                  Login
                </VBtn>
              </VCol>

              <!-- create account -->
              <VCol
                cols="12"
                class="text-center text-base"
              >
                <span>New on our platform?</span>
                <Link
                  class="text-primary ms-2"
                  href="/register"
                >
                  Create an account
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
