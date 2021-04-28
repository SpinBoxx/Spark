document.addEventListener('DOMContentLoaded', function() {
    var userRating = document.querySelector('.js-src-questions');
    var questions = JSON.parse(userRating.dataset.questions);

    console.log(questions);
    const autoCompleteJS = new autoComplete({
        placeHolder: "Une question ?",
        data: {
            src: questions,
            key: ["q"],
        },

        resultsList: {
            noResults: (list, query) => {
                const message = document.createElement("li");
                message.setAttribute("class", "no_result");
                message.setAttribute("tabindex", "1");
                message.innerHTML = `<span style="display: flex; align-items: center; font-weight: 100; color: rgba(0,0,0,.2);">Pas de resultat pour "${query}"</span>`;
                list.appendChild(message);
            },
        },
        resultItem: {
            highlight: {
                render: true
            },
            content: (data, element) => {
                console.log(data);
                // Modify Results Item Style
                element.style = "display: flex; justify-content: space-between;";
                // Modify Results Item Content
                element.innerHTML = `<span style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
        ${data.match}</span>`;
            }
        },
        onSelection: (feedback) => {
            console.log(feedback.selection.value.id);
            var question_id =feedback.selection.value.id;
            $('#flush-heading'+question_id).get(0).scrollIntoView();
            $('#flush-'+question_id).collapse('toggle');
        }
    });
});
