<script setup>
// Your Supabase logic goes here
</script>

<template>
  <div class="container-fluid">
    <!-- Alerts -->
    <!--
    <div class="alert alert-success">News added successfully!</div>
    <div class="alert alert-danger">Error message here</div>
    -->

    <div class="row mt-4">
      <!-- FORM -->
      <div class="col-md-4">
        <form>
          <div class="card">
            <div class="card-header">
              <h3>News / Announcement Form</h3>
            </div>
            <div class="card-body">
              <div class="form-group mb-3">
                <label for="">Title:</label>
                <input type="text" class="form-control" required />
              </div>

              <div class="form-group mb-3">
                <label for="">Content:</label>
                <textarea class="form-control" rows="5" required></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="">Cover Image:</label>
                <input type="file" class="form-control" accept="image/*" />
              </div>

              <div class="form-group mb-3">
                <label for="">Date:</label>
                <input type="date" class="form-control" required />
              </div>

              <div class="form-check form-switch mb-3">
                <input
                  class="form-check-input"
                  type="checkbox"
                  role="switch"
                  id="isPublished"
                  checked
                />
                <label class="form-check-label" for="isPublished"
                  >Published</label
                >
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success px-5 m-2 float-end">
                Save Changes
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- TABLE -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3>News & Announcements</h3>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Image</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Example row, replace with v-for -->
                <tr>
                  <td class="text-center">1</td>
                  <td class="text-center">
                    <div
                      style="
                        width: 60px;
                        height: 45px;
                        background: #dfe3ea;
                        border-radius: 4px;
                      "
                    ></div>
                  </td>
                  <td>Budget Consultation Meeting Held</td>
                  <td class="text-center">Aug 4, 2026</td>
                  <td class="text-center">
                    <span class="badge bg-success">Published</span>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-warning btn-sm me-1">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger btn-sm">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
