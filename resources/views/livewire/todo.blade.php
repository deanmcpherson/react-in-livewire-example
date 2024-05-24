<?php

use function Livewire\Volt\{state};

Mingle::volt();
state([
    'tasks' => []
]);

$addTask = function($taskText) {
    $task = [
        'id' => Str::random(10),
        'text' => $taskText
];
    $this->tasks[] = $task;
};

$removeTask = function($taskId) {
   $tasks = array_values(array_filter($this->tasks, function($task) use ($taskId) {
        return $task['id'] !== $taskId;
    }));
    $this->tasks = $tasks;
};

?>
<script>
import Button from '@/Button';
function render({wire: {tasks, addTask, removeTask}}) {
    return <div className=" border p-4 rounded-lg mt-2">
            <ul>{
                tasks?.map(task => {
                   return <li className="w-full flex">{task.text} <button className="ml-auto" onClick={() => {
                        removeTask(task.id)
                    }}>x</button></li>
                })
            }
            </ul>
            {
                !tasks.length && <div>No tasks</div>
            }
            <input type="text"
            className="bg-white h-8 text-black rounded border-none w-full"
            placeholder="Add Todo"
            onKeyPress={(e) => {
                if (e.key === 'Enter') {
                    addTask(e.target.value)
                    e.target.value = ''
                }
            }} />
        </div>
}
</script>
