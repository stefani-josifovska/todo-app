<template>
  <div class="container d-flex w-75 col bg-light bg-gradient rounded-3 m-3 p-3 mx-auto">
    <div class="text-start w-100">
      <div class="row">
        <h2>{{ title }}</h2>
      </div>
      <div class="row text-black-50">
        <p>{{ person }}</p>
      </div>
      <div class="row text-muted">
        <p>{{ description }}</p>
      </div>
    </div>
    <div class="flex-column d-flex justify-content-around flex-shrink-1">
      <div v-show="!displayEdit">
        <ButtonUI
          btnText="Edit Task"
          @click="onEditHandler(id)"
          class="btn btn-success m-2 btn-sm w-100"
        />
        <ButtonUI
          btnText="Delete Task"
          @click="onDeleteHandler(id)"
          class="btn btn-danger m-2 btn-sm w-100"
        />
      </div>
    </div>
    <div v-show="displayEdit">
      <EditTask
        :taskTitle="title"
        :taskDesc="description"
        :taskPerson="person"
        :taskId="id"
        @cancel-edit-task="cancelEdit"
      />
    </div>
  </div>
</template>

<script>
import ButtonUI from "./ButtonUI.vue";
import EditTask from "../EditTask.vue";
export default {
  name: "SingleTask",
  data() {
    return {
      displayEdit: false,
    };
  },
  props: {
    id: Number,
    title: String,
    isDone: Boolean,
    person: String,
    description: String,
    dateTime: Date,
  },
  components: { ButtonUI, EditTask },
  methods: {
    onDeleteHandler(id) {
      this.$emit("delete-task", id);
    },
    onEditHandler(id) {
      this.$emit("edit-task-display", id);
      this.displayEdit = true;
    },
    cancelEdit() {
      this.displayEdit = false;
    },
  },
  emits: ["delete-task", "edit-task-display"],
};
</script>
