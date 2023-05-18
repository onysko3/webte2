let textarea;


document.addEventListener("DOMContentLoaded", function() {

    let showTask = document.getElementById("math");
    console.log(id);
    console.log(task);
    console.log(resultRoute);
    showTask.innerText = task.assignment;

    renderMathInElement(document.getElementById("math"), {
        // customised options
        // • auto-render specific keys, e.g.:
        delimiters: [
            {left: '$$', right: '$$', display: true},
            {left: '$', right: '$', display: false},
            {left: '\\(', right: '\\)', display: false},
            {left: '\\[', right: '\\]', display: true}
        ],
        // • rendering keys, e.g.:
        throwOnError : false
    });

    if (task.img_name != null){
        let showImg = document.createElement("img");
        showImg.src = task.img_name;
        document.getElementById("task").append(showImg);
    }

    createEditor();

    textarea = EqEditor.TextArea.link('latexInput')
        .addOutput(new EqEditor.Output('output'))
        .addHistoryMenu(new EqEditor.History('history'));

    EqEditor.Toolbar.link('toolbar').addTextArea(textarea);


});

//result = nerdamer.convertFromLaTeX(result);

//result = nerdamer(result.text('simplify'));

function createEditor(){
    let editorDiv = document.createElement("div");
    editorDiv.id = "equation-editor";
    let historyDiv = document.createElement("div");
    historyDiv.id = "history";
    editorDiv.append(historyDiv);
    let toolbarDiv = document.createElement("div");
    toolbarDiv.id = "toolbar";
    editorDiv.append(toolbarDiv);
    let label = document.createElement("label");
    label.setAttribute("for", "latexInput");
    label.id = "label";
    label.innerText = "Tu zadajte riešenie príkladu v latexovom tvare:";
    editorDiv.append(label);
    let inputDiv = document.createElement("div");
    inputDiv.id = "latexInput";
    inputDiv.setAttribute("autocorrect", "off");
    editorDiv.append(inputDiv);
    let outputDiv = document.createElement("div");
    outputDiv.id = "equation-output";
    editorDiv.append(outputDiv);
    let outputImg = document.createElement("img");
    outputImg.id = "output";
    outputDiv.append(outputImg);
    let button = document.createElement("button");
    button.setAttribute("type", "button");
    button.classList.add("btn");
    button.classList.add("btn-danger");
    //button.setAttribute("onclick", "resultEquals(e)");
    button.addEventListener('click', (e) => resultEquals(e))
    button.innerText = "Odoslať riešenie";
    editorDiv.append(button);
    document.getElementById("editorBody").append(editorDiv);

}

function resultEquals(e){
    e.preventDefault();

    //let result = 'y(t)=\\dfrac{1}{12} - \\dfrac{3}{2}e^{-t} + \\dfrac{1}{6}e^{-3t} + \\dfrac{1}{4}e^{-4t} = 0.0833 -1.5 e^{-t} + 0.1666 e^{-3t} + 0.25 e^{-4t}';
    let correctResults = task.results;
    correctResults = correctResults.replace(/\\dfrac/g, "\\frac"); // replace \dfrac with frac
    let results = correctResults.split("=");
    for (let i = 0; i<results.length; i++){
        //console.log(results[i]);
        results[i] = nerdamer.convertFromLaTeX(results[i]);

    }

    let resultInputConv = document.getElementById("latexInput").innerText.toString();
    let resultInput = resultInputConv;
    resultInputConv = resultInputConv.replace(/\\dfrac/g, "\\frac"); // replace \dfrac with frac
    resultInputConv = nerdamer.convertFromLaTeX(resultInputConv);



    let w = false;
    for (let i = 0; i < results.length; i++){
        if (resultInputConv.eq(results[i])){
            console.log("correct " + i);
            w = true;
            break;
        }
    }
    if (!w){
        console.log("incorrect");
    }


    var cookie = $.cookie("laravel_session");
    console.log(cookie);

    /*fetch(resultRoute, {
        method: 'POST',
        body: {
            submitted_result: resultInput,
            is_result_correct: w
        }
    }).then(response => response.json())
        .then(data => {
            window.location.href = data.redirect;
        })
        .catch(error => {
            // Handle any errors
        });*/

    console.log(resultRoute);
   axios.post(resultRoute, {
       _token: token,
       submitted_result: resultInput,
        is_result_correct: w,
    }).then((response) => {
        console.log(response)
            window.location.href = response.request.responseURL;
        });

}
