<template>
  <div class="container mt-5">
    <div class="row justify-content-end">
      <div class="col-4">
        <button class="btn btn-info">
          <i class="fas fa-plus"></i>
          Create
        </button>
      </div>
      <!-- SEARCH  -->
      <div class="col-4">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search Name" />
          <div class="input-group-append">
            <button class="btn btn-primary" type="button" id="button-addon2">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- FORM -->
    <div class="row">
      <div class="col-4">
        <div class="card">
          <div class="card-header">
            <h4>Create</h4>
          </div>
          <div class="card-body">
            <form action="">
              <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" />
              </div>
              <div class="form-group">
                <label>Price:</label>
                <input type="number" class="form-control" />
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- TABLE -->
      <div class="col-8">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in products" :key="product.id">
              <th scope="row">{{ product.id }}</th>
              <td>{{ product.name }}</td>
              <td>{{ product.price }}</td>
              <td>
                <button class="btn btn-success btn-sm">
                  <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-danger btn-sm">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductComponent",
  data() {
    return {
      products: [],
    };
  },
  created() {
    axios.get("/api/products").then((response) => {
      this.products = response.data;
    });
  },
};
</script>
