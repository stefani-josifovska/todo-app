<template>
  <AppHeader @disp-add-task="toggleAddTask" :displayAddTask="displayAddTask" />
  <div v-show="displayAddTask">
    <AddTask taskData="newTaskData" @add-task="addTask" />
  </div>
  <FilterTasks @filter-tasks="onFilterTasks" />
  <AllTasks
    :tasks="tasks"
    :filterText="filterText"
    @delete-task="deleteTask"
    @edit-task-display="editTask"
  />
</template>

<script>
import AppHeader from "./components/AppHeader.vue";
import AllTasks from "./components/AllTasks.vue";
import AddTask from "./components/AddTask.vue";
import FilterTasks from "./components/FilterTasks.vue";
export default {
  name: "App",
  components: { AppHeader, AllTasks, AddTask, FilterTasks },
  data: () => ({
    tasks: [],
    displayAddTask: false,
    displayEditTask: false,
    editedTask: {},
    filterText: "",
  }),
  methods: {
    deleteTask(id) {
      if (confirm("Are you sure you want to delete this task?")) {
        this.tasks = this.tasks.filter((task) => task.id !== id);
      }
    },
    async addTask(taskData) {
      if (
        taskData.title.trim().length > 0 &&
        taskData.description.trim().length > 5 &&
        taskData.person.trim().length > 0
      ) {
        taskData = {
          ...taskData,
          isDone: false,
          doneTime: null,
          id: Math.random(),
        };
        // console.log(taskData);
        const res = await fetch("http://localhost/db_post.php", {
          method: "POST",
          headers: {
            // "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
            // "Content-Type": "application/json",
          },
          body: JSON.stringify(taskData),
        });
        const data = await res.json();
        this.tasks = [...this.tasks, data];
        // this.fetchTasks();
        this.displayAddTask = false;
      }
    },
    toggleAddTask() {
      this.displayAddTask = !this.displayAddTask;
    },
    editTask(id) {
      this.displayEditTask = true;
      this.editedTask = this.tasks.find((task) => task.id === id);
    },
    cancelEdit() {
      this.displayEditTask = false;
    },
    onFilterTasks(text) {
      this.filterText = text;
    },
    async fetchTasks() {
      const res = await fetch("http://localhost/db_conn.php");
      const tasks = await res.json();
      for (const task of tasks) {
        if (task.isDone === 0) {
          task.isDone = false;
        } else if (task.isDone === 1) {
          task.isDone = true;
        }
      }
      return tasks;
    },
  },
  async created() {
    this.tasks = await this.fetchTasks();
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
}
</style>
