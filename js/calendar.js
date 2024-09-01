document.getElementById("attendanceForm").addEventListener("submit", (event) => {
    event.preventDefault();

    // Retrieve form values
    let year = parseInt(document.getElementById("yearSelect").value);
    let month = parseInt(document.getElementById("monthSelect").value);
    let subjectSelect = document.getElementById("subjectSelect").value;

    // Fetch attendance data
    fetch("includes/subjects_data.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({
            subjectSelect: subjectSelect,
            year: year,
            month: month
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(data);
            // Generate calendar only if data is valid
            generateCalendar(year, month, data.data);
        } else {
            console.error('Error fetching data:', data.message || 'Unknown error');
        }
    })
    .catch(error => console.error('Fetch error:', error));
});

function generateCalendar(year, month, data) {
    let calendarContainer = document.getElementById("calendar");
    calendarContainer.innerHTML = "";

    let firstDay = new Date(year, month, 1);
    let lastDay = new Date(year, month + 1, 0);
    let numDays = lastDay.getDate();
    let calendar = document.createElement("table");
    calendar.className = 'w-full text-center border-collapse';

    let html = `<thead><tr>`;
    ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"].forEach(day => {
        html += `<th class="border px-4 py-2">${day}</th>`;
    });
    html += `</tr></thead><tbody><tr>`;

    let startDay = (firstDay.getDay() + 6) % 7; // Adjust to start the calendar on Monday

    // Add empty cells before the first day
    for (let i = 0; i < startDay; i++) {
        html += `<td class="border px-4 py-2"></td>`;
    }

    // Add days of the month
    for (let i = 1; i <= numDays; i++) {
        let date = new Date(year, month, i+1);
        let dateString = date.toISOString().split('T')[0];
        let attendance = data.find(row => row.date === dateString);

        html += `<td class="border px-4 py-3" data-date="${dateString}">${i}`;
        if (attendance) {
            html += `<br><b>${attendance.STATUS}</b>`;
        }
        html += `</td>`;

        // Create a new row at the end of the week
        if ((startDay + i) % 7 === 0 && i < numDays) {
            html += `</tr><tr>`;
        }
    }

    // Add empty cells after the last day
    if ((startDay + numDays) % 7 !== 0) {
        let emptyCells = 7 - ((startDay + numDays) % 7);
        html += `<td class="px-4 py-2 border"></td>`.repeat(emptyCells);
    }
    html += `</tr></tbody>`;
    
    calendar.innerHTML = html;
    calendarContainer.appendChild(calendar);
}
