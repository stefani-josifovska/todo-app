<template>
  <div class="container bg-light mb-3 w-75 col-md-8 offset-md-2">
    <form @submit="onSubmitHandler" action="">
      <FormKit
        type="text"
        label="Task Title"
        placeholder="Write the task title"
        validation="required|length:3"
        v-model="title"
      />
      <FormKit
        type="textarea"
        label="Task Description"
        placeholder="Write down the task description"
        validation="required|length:5"
        v-model="description"
      />
      <FormKit
        type="text"
        label="Assigned to:"
        placeholder="Who is this task assigned to?"
        validation="required"
        v-model="person"
      />
      <ButtonUI
        btnText="Save Task"
        type="submit"
        label="Save Task"
        class="btn btn-success"
        @click="onSubmitHandler"
      />
    </form>
    <p v-if="isFormInvalid">Please ented valid information!</p>
  </div>
</template>

<script>
import ButtonUI from "./UI/ButtonUI.vue";
export default {
  name: "AddTask",
  data() {
    return {
      title: "",
      description: "",
      person: "",
      isFormInvalid: false,
    };
  },
  methods: {
    onSubmitHandler(e) {
      e.preventDefault();
      if (
        this.title.trim().length > 0 &&
        this.description.trim().length > 0 &&
        this.person.trim().length > 0
      ) {
        const newTaskData = {
          id: Math.random(),
          title: this.title,
          description: this.description,
          person: this.person,
          isDone: false,
        };
        this.$emit("add-task", newTaskData);
        this.isFormInvalid = false;
      } else {
        this.isFormInvalid = true;
      }
    },
  },
  components: { ButtonUI },
};
</script>
