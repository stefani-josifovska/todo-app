<template>
  <form @submit="onEditHandler" action="" class="w-100">
    <FormKit
      type="text"
      label="Task Title"
      placeholder="Write the task title"
      validation="required"
      v-model="title"
      class="form-control"
    />
    <FormKit
      type="textarea"
      label="Task Description"
      placeholder="Write down the task description"
      validation="required"
      v-model="description"
    />
    <FormKit
      type="text"
      label="Assigned to:"
      placeholder="Who is this task assigned to?"
      validation="required"
      v-model="person"
    />
    <ButtonUI btnText="Save Task" type="submit" label="Save Task" class="btn btn-success" />
    <ButtonUI btnText="Cancel" @click="cancelHandler" class="btn btn-danger" />
  </form>
</template>

<script>
import ButtonUI from "./UI/ButtonUI.vue";
export default {
  name: "EditTask",
  //   state
  data() {
    return {
      title: this.taskTitle,
      description: this.taskDesc,
      person: this.taskPerson,
    };
  },
  props: {
    taskTitle: String,
    taskDesc: String,
    taskPerson: String,
    taskId: Number,
  },
  //   actions
  methods: {
    onEditHandler(e) {
      e.preventDefault();
      // emit data
      const editedData = {
        id: this.taskId,
        title: this.title,
        description: this.description,
        person: this.person,
      };

      this.$emit("edited-data", editedData);
    },
    cancelHandler() {
      this.$emit("cancel-edit-task");
    },
  },
  components: { ButtonUI },
  emits: ["cancel-edit-task", "edited-data"],
};
</script>
