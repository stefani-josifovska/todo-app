<template>
  <nav class="navbar p-4 bg-light bg-gradient mb-4">
    <h1 class="m-0">To-Do List</h1>
    <ButtonUI
      :btnText="displayAddTask ? 'Collapse' : 'Add Task'"
      @click="toggleAddTask"
      type="button"
      :class="[displayAddTask ? 'btn btn-dark' : 'btn btn-success']"
    />
  </nav>
</template>

<script>
import ButtonUI from "./UI/ButtonUI.vue";
export default {
  name: "AppHeader",
  components: { ButtonUI },
  methods: {
    toggleAddTask() {
      this.$emit("disp-add-task");
    },
  },
  props: {
    displayAddTask: Boolean,
  },
};
</script>
