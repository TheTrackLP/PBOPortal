<script setup>
// Your Supabase logic goes here
</script>

<template>
  <div class="container-fluid">
    <!-- Success/Error alerts -->
    <!--
    <div class="alert alert-success">Accomplishment added successfully!</div>
    <div class="alert alert-danger">Error message here</div>
    -->

    <div class="row mt-4">
      <!-- FORM -->
      <div class="col-md-4">
        <form>
          <div class="card">
            <div class="card-header">
              <h3>Accomplishment Form</h3>
            </div>
            <div class="card-body">
              <div class="form-group mb-3">
                <label for="">Title:</label>
                <input type="text" class="form-control" required />
              </div>

              <div class="form-group mb-3">
                <label for="">Year:</label>
                <input
                  type="number"
                  class="form-control"
                  min="2000"
                  max="2100"
                  required
                />
              </div>

              <div class="form-group mb-3">
                <label for="">PDF File:</label>
                <input
                  type="file"
                  class="form-control"
                  accept="application/pdf"
                  required
                />
                <small class="text-muted"
                  >Upload the report PDF (max size TBD)</small
                >
              </div>

              <div class="form-group mb-3">
                <label for="">Display Order:</label>
                <input type="number" class="form-control" min="0" />
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
            <h3>Accomplishments</h3>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-hover">
              <thead class="table-dark">
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Year</th>
                  <th class="text-center">File</th>
                  <th class="text-center">Order</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Example row, replace with v-for -->
                <tr>
                  <td class="align-middle text-center">1</td>
                  <td class="align-middle">Annual Budget Utilization Report</td>
                  <td class="align-middle text-center">2026</td>
                  <td class="align-middle text-center">
                    <a href="#" target="_blank">
                      <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                      View
                    </a>
                  </td>
                  <td class="align-middle text-center">1</td>
                  <td class="align-middle text-center">
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
