document.getElementById('show_attendance').onsubmit = function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the selected date
    const date = document.querySelector('input[name="date"]').value;
    if (!date) {
        alert('Please select a date.');
        return;
    }

    // Send an AJAX request to the server
    fetch('includes/fetch_attendance.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'date': date
        })
    })
    .then(response => {
        return response.json()
    })
    .then(data => {

        // Populate the table with the response data
      let tableHtml = `
        <table class="w-50 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs uppercase bg-gray-700 text-gray-400 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Subject
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>`;
        data.forEach(row => {
            tableHtml += `
            <tr class="bg-gray-800 border-gray-700 border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                    ${row.subject_name}
                </th>
                <td class="px-6 py-4">
                    ${row.status || "Not marked yet"}
                </td>
            </tr>`;
        });
       
        tableHtml += `</tbody></table>`; 
        
        document.getElementById('table').innerHTML = tableHtml;  
        updateBtn();
        
    
    });
   
    function createButton(){
        let btn = document.createElement("button");
        btn.className = 'mt-20 bg-yellow-700 text-white border border-gray-600 hover:border-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-700 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-yellow-700 dark:text-white dark:border-gray-600 dark:hover:border-gray-600 dark:focus:ring-gray-700';
        btn.innerHTML = "See your attendance statistics";
        btn.id = "statisticsBtn";
        btn.onclick = function(){
           window.location.href = "statistics.php";
        }
        return btn;
    }
    function updateBtn(){
        let statsContainer = document.getElementById("statistics");
        let existingBtn = document.getElementById("statisticsBtn");
        if(existingBtn){
            statsContainer.removeChild(existingBtn);
        }
        else {
            console.log("no existing btn");
        }
        statsContainer.appendChild(createButton());
    }  
 
   
};


