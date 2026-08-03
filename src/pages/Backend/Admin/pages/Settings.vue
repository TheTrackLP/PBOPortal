<script setup></script>
<template>
  <div>
    <div class="container py-4">
      <h3 class="mb-4">Office Settings</h3>
      <form @submit.prevent="">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Office Name</label>
                <input type="text" class="form-control" />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Office Address</label>
                <input type="text" class="form-control" />
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Map Embed URL</label>
              <input
                type="text"
                class="form-control"
                placeholder="Paste Google Maps embed src here"
              />
              <small class="text-muted">
                Google Maps → Share → Embed a map → copy the src URL.
              </small>
            </div>
            <div class="mb-4">
              <label class="form-label d-block">Preview</label>
              <iframe
                src=""
                width="100%"
                height="300"
                style="border: 0"
                loading="lazy"
              ></iframe>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Contact Number</label>
                <input type="text" class="form-control" />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" />
              </div>
            </div>
            <hr />
            <div class="mb-3">
              <label class="form-label">Office Photo</label>
              <input type="file" class="form-control" accept="/img/settings" />
            </div>
            <div class="mb-4">
              <label class="form-label d-block">Preview</label>
              <iframe
                src=""
                width="100%"
                height="300"
                style="border: 0"
                loading="lazy"
              ></iframe>
            </div>
            <div class="mb-4">
              <label class="form-label d-block">Preview</label>
              <iframe
                src=""
                width="100%"
                height="300"
                style="border: 0"
                loading="lazy"
              ></iframe>
            </div>
          </div>

          <div class="card-footer d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary">
              <span class="spinner-border spinner-border-sm me-1"></span>
              Save Settings
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
