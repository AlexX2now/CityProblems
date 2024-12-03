$(document).ready(function(){
    function loadSolvedIssues() {
        $('#solvedIssues').empty();
        
        // Выполнить AJAX запрос к серверу для загрузки данных из базы данных
        $.ajax({
            url: 'load_solved_issues.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                response.forEach(function(issue) {
                    var issueDiv = $('<div class="col-sm-6 col-md-3">');
                    issueDiv.html(`
                        <div class="thumbnail">
                            
                            <img src="${issue.after_photo}" class="imageaf" alt="Фото после решения проблемы">
                            <img src="${issue.before_photo}" class="imagebe" alt="Фото до решения проблемы">
                            <div class="caption">
                                <h3>${issue.title}</h3>
                                <p>${issue.description}</p>
                                <p>Категория: ${issue.category}</p>
                                <p>Временная метка: ${issue.timestamp}</p>
                            </div>
                            <div class="slider"></div>
                        </div>
                    `);
                    $('#solvedIssues').append(issueDiv);
                    
                
                    issueDiv.find('.slider').slider({
                        orientation: "horizontal",
                        range: "max",
                        min: 0,
                        max: 100,
                        slide: function(event, ui) {
var offset = 100 - ui.value + '%';
$(this).siblings('img').eq(0).css('clip-path', 'inset(0 0 0 ' + offset + ')'); // Adjusted clip-path value
}
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error('Error loading solved issues:', error);
            }
        });
    }
    loadSolvedIssues();
});