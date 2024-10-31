document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('taskPieChart');
    if (ctx) {
        const taskPieChart = new Chart(ctx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: [
                    `To Do (${(todoTasksCount / (todoTasksCount + reviewTasksCount + completedTasksCount + pendingTasksCount)) * 100}%)`,
                    `In Progress (${(pendingTasksCount / (todoTasksCount + reviewTasksCount + completedTasksCount + pendingTasksCount)) * 100}%)`,
                    `Review (${(reviewTasksCount / (todoTasksCount + reviewTasksCount + completedTasksCount + pendingTasksCount)) * 100}%)`,
                    `Completed (${(completedTasksCount / (todoTasksCount + reviewTasksCount + completedTasksCount + pendingTasksCount)) * 100}%)`
                ],
                datasets: [{
                    label: 'Count By Status',
                    data: [todoTasksCount, pendingTasksCount, reviewTasksCount, completedTasksCount],
                    backgroundColor: ['#B5B9BB', '#1993D5', '#D51919', '#26532B'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Distribution of Task Status'
                    }
                }
            }
        });
    } else {
        console.error('Canvas element not found');
    }
});
