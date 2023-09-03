<template>
  <div>
    <form class="bg-gray-100 mx-auto p-4 rounded w-3/4" @submit="submit">
      <div class="form-group">
        <h2 class="text-xl">Laravel test</h2>
        <span v-if="failed" class="text-red-600"
          >Form has been not submitted</span
        >
        <span v-if="success" class="text-green-600"
          >Form has been submitted successfully</span
        >
        <div
          v-for="(formValue, index) in formsValues"
          :key="`stepInput-${index}`"
          class="input wrapper flex justify-between items-center"
        >
          <div class="w-full mt-2">
            <div class="flex">
              <div class="w-1/4">
                <p>Personal Information</p>
              </div>
              <div class="w-3/4 flex">
                <input
                  v-model="formValue.name"
                  type="text"
                  class="h-10 rounded-lg outline-none p-2 mx-2 w-56"
                  placeholder="name"
                  required
                />
                <input
                  v-model="formValue.mobile"
                  type="number"
                  class="h-10 rounded-lg outline-none p-2 mx-2 w-56"
                  placeholder="Mobile"
                  required
                />
                <input
                  v-model="formValue.email"
                  type="email"
                  class="h-10 rounded-lg outline-none p-2 mx-2 w-56"
                  placeholder="email"
                  required
                />
              </div>
            </div>

            <div class="flex mt-2">
              <div class="w-1/4">Address</div>
              <div class="flex w-3/4">
                <!-- Country  -->
                <select
                  required
                  name=""
                  class="h-10 rounded-lg outline-none p-2 mx-2 w-56"
                  v-model="formValue.country"
                  @change="getStates($event, index)"
                >
                  <option value="">Select Country</option>

                  <option
                    v-for="country in countries"
                    :key="country.id"
                    :value="country.id"
                  >
                    {{ country.name }}
                  </option>
                </select>
                <!-- state -->
                <select
                  required
                  name=""
                  class="h-10 rounded-lg outline-none p-2 mx-2 w-56"
                  v-model="formValue.state"
                  @change="getCities($event, index)"
                >
                  <option value="">Select State</option>

                  <option
                    v-for="state in states[index]"
                    :key="state.id"
                    :value="state.id"
                  >
                    {{ state.name }}
                  </option>
                </select>
                <!-- city -->
                <select
                  required
                  name=""
                  class="h-10 rounded-lg outline-none p-2 mx-2 w-56"
                  v-model="formValue.city"
                >
                  <option value="">Select City</option>

                  <option
                    v-for="city in cities[index]"
                    :key="city.id"
                    :value="city.id"
                  >
                    {{ city.name }}
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="mx-6">
            <svg
              v-show="formsValues.length > 1"
              @click="removeField(index, formsValues)"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              class="ml-2 cursor-pointer"
            >
              <path fill="none" d="M0 0h24v24H0z" />
              <path
                fill="#EC4899"
                d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9.414l2.828-2.829 1.415 1.415L13.414 12l2.829 2.828-1.415 1.415L12 13.414l-2.828 2.829-1.415-1.415L10.586 12 7.757 9.172l1.415-1.415L12 10.586z"
              />
            </svg>
          </div>
        </div>
      </div>
      <div class="flex w-full justify-center">
        <button
          type="button"
          @click="addField(input, formsValues)"
          class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mx-3 mt-3"
        >
          Add more
        </button>
        <button
          type="submit"
          class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded mx-3 mt-3"
        >
          Submit
        </button>
      </div>
    </form>
  </div>
</template>
  
  <script>
import axios from "axios";
export default {
  name: "AddRemove",
  data() {
    return {
      success: false,
      failed: false,
      formsValues: [
        {
          name: "",
          email: "",
          mobile: "",
          city: "",
          state: "",
          country: "",
        },
      ],
      countries: {},
      states: {},
      cities: {},
    };
  },
  beforeMount() {
    this.getCountries();
  },
  methods: {
    addField(value, fieldType) {
      fieldType.push({ value: "" });
    },
    removeField(index, fieldType) {
      fieldType.splice(index, 1);
    },
    submit(event) {
      event.preventDefault();

      axios
        .post("api/add-users", this.formsValues)
        .then(() => {
          this.success = true;
          this.failed = false;
          this.formsValues = {};
        })
        .catch((error) => {
          console.warn(error);
          this.failed = true;
          this.success = false;
        });
    },
    getCountries() {
      axios.get("api/country").then((response) => {
        this.countries = response.data;
      });
    },

    getStates(event, index) {
      axios.get(`api/state/${event.target.value}`).then((response) => {
        this.states[index] = response.data;
        console.log(this.states[index]);
        console.log(response.data);
      });
    },

    getCities(event, index) {
      axios.get(`api/city/${event.target.value}`).then((response) => {
        this.cities[index] = response.data;
        console.log(response.data);
      });
    },
  },
};
</script>
  
  <style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
  