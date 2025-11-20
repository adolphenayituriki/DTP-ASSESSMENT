document.getElementById("issueForm").addEventListener("submit", function(e){
      e.preventDefault();
      alert("Your issue has been submitted!");
    // later: send via fetch() to PHP API
});

