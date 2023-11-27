<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3'
import { reactive } from 'vue'
import BlankLayout from '../layouts/blank.vue'
import AuthProvider from '@/views/pages/authentication/AuthProvider.vue'
import logo from '@images/logo.svg?raw'

const isPasswordVisible = ref(false)

const form = reactive({
  email: null,
  password: null,
})

function submit() {
  router.post('/login', form)
}
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
            Learning Management System
          </VCardTitle>
        </VCardItem>
        <VCardText class="pt-2">
          <h5 class="text-h5 mb-1">
            Welcome to Learning Management System! 👋🏻
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
                  autofocus="true"
                  placeholder="johndoe@email.com"
                  label="Email"
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
