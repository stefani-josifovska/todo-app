<template>
  <input
    class="form-control w-75 m-auto"
    type="search"
    placeholder="Search by Task Title"
    aria-label="Search"
    v-model="filteredTask"
  />
</template>

<script>
export default {
  name: "FilterTasks",
  data() {
    return {
      filteredTask: "",
    };
  },
  watch: {
    filteredTask(e) {
      this.filteredTask = e;
      this.$emit("filter-tasks", this.filteredTask);
    },
  },
};
</script>
