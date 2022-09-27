<template>
  <div :key="task.id" v-for="task in filtTask">
    <SingleTask
      :id="task.id"
      :title="task.title"
      :isDone="task.isDone"
      :person="task.person"
      :description="task.description"
      :dateTime="task.dateTime"
      @delete-task="$emit('delete-task', task.id)"
      @edit-task-display="$emit('edit-task-display', task.id)"
    />
  </div>
</template>

<script>
import SingleTask from "./UI/SingleTask.vue";
export default {
  name: "AllTasks",
  props: {
    tasks: Array,
    filterText: String,
  },
  components: { SingleTask },
  emits: ["delete-task", "edit-task-display"],
  computed: {
    filtTask() {
      if (this.filterText.length > 0) {
        return this.tasks.filter((task) =>
          task.title.toLowerCase().includes(this.filterText.toLowerCase())
        );
      }
      return this.tasks;
    },
  },
};
</script>
