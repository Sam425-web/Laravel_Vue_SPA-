<template>
  <div class="container mt-5">
    <div class="row justify-content-end">
      <div class="col-4">
        <button class="btn btn-info" @click="create">
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
            <h4>{{ isEditMode ? "Edit" : "Create" }}</h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="isEditMode ? update() : store()">
              <div class="form-group">
                <label>Name:</label>
                <input
                  v-model="product.name"
                  type="text"
                  class="form-control"
                />
              </div>
              <div class="form-group">
                <label>Price:</label>
                <input
                  v-model="product.price"
                  type="number"
                  class="form-control"
                />
              </div>
              <button type="submit" class="btn btn-block btn-info">
                <i class="fas fa-save"></i> Save
              </button>
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
                <button class="btn btn-success btn-sm" @click="edit(product)">
                  <i class="fas fa-edit"></i>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="destory(product.id)"
                >
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
      isEditMode: false,
      products: [],
      product: {
        id: "",
        name: "",
        price: "",
      },
    };
  },
  methods: {
    view() {
      axios.get("/api/products").then((response) => {
        this.products = response.data;
      });
    },
    create() {
      this.isEditMode = false;
      this.product.id = "";
      this.product.name = "";
      this.product.price = "";
    },
    edit(product) {
      this.isEditMode = true;
      this.product.id = product.id;
      this.product.name = product.name;
      this.product.price = product.price;
    },
    update() {
      axios
        .put(`/api/products/${this.product.id}`, this.product)
        .then((response) => {
          this.view();
          this.product.id = "";
          this.product.name = "";
          this.product.price = "";
        });
    },
    store() {
      axios.post("/api/products", this.product).then((response) => {
        this.view();
        this.product = { name: "", price: "" };
      });
    },
    destory(id) {
      if (!confirm("Are u Sure to Delete?")) {
        return;
      }
      axios.delete(`/api/products/${id}`).then((response) => this.view());
    },
  },
  created() {
    this.view();
  },
};
</script> 
