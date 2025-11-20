document.getElementById("issueForm").addEventListener("submit", function(e){
      e.preventDefault();
      alert("Your issue has been submitted!");
    // later: send via fetch() to PHP API
});

document.addEventListener("DOMContentLoaded", () => {

    // Load issues when the modal is opened
      const viewModal = document.getElementById("viewIssueModal");
      viewModal.addEventListener("show.bs.modal", loadIssues);

});

function loadIssues() {
      fetch("api/get_issues.php")
            .then(response => response.json())
            .then(data => {
                  const tableBody = document.querySelector("#issuesTable tbody");
                  tableBody.innerHTML = "";

                  data.forEach(issue => {
                  tableBody.innerHTML += `
                        <tr>
                              <td>${issue.id}</td>
                              <td>${issue.title}</td>
                              <td>${issue.description}</td>
                              <td>${issue.reporter}</td>
                              <td>${issue.created_at}</td>
                        </tr>
                  `;
            });
      })
      .catch(error => console.error("Error loading issues:", error));
}


function updateDateTime(){
      let now = new Date();
      let time = now.toLocaleTimeString();
      let year = now.toTimeString();
      document.getElementById("time").textContent = "("+year+")";
      document.getElementById("time").style.color = "#0995a5ff"
}
setInterval(updateDateTime, 1000);
updateDateTime();

document.getElementById('issueForm').addEventListener('submit', function(e) {
    e.preventDefault(); // prevent page reload

    let formData = new FormData(this);

    fetch('submit_issue.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            this.reset(); // clear the form
            const modal = bootstrap.Modal.getInstance(document.getElementById('reportModal'));
            modal.hide(); // hide modal
        }
    })
    .catch(err => console.error(err));
});








