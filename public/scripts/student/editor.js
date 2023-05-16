let textarea;


document.addEventListener("DOMContentLoaded", function() {

    let showTask = document.getElementById("math");
    showTask.innerText = task.task;

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

    if (task.img_path != null){
        let showImg = document.createElement("img");
        showImg.src = task.img_path;
        document.getElementById("task").append(showImg);
    }

    createEditor();

    textarea = EqEditor.TextArea.link('latexInput')
        .addOutput(new EqEditor.Output('output'))
        .addHistoryMenu(new EqEditor.History('history'));

    EqEditor.Toolbar.link('toolbar').addTextArea(textarea);


});

let result = 'y(t)=\\dfrac{1}{12} - \\dfrac{3}{2}e^{-t} + \\dfrac{1}{6}e^{-3t} + \\dfrac{1}{4}e^{-4t} = 0.0833 -1.5 e^{-t} + 0.1666 e^{-3t} + 0.25 e^{-4t}';
result = result.replace(/\\dfrac/g, "\\frac"); // replace \dfrac with frac
let results = result.split("=");
for (let i = 0; i<3; i++){
    results[i] = nerdamer.convertFromLaTeX(results[i]);
}
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
    button.setAttribute("onclick", "getEq()");
    button.innerText = "Odoslať riešenie"
    editorDiv.append(button);
    document.getElementById("editorBody").append(editorDiv);

}

function getEq(){
    console.log(results);

    let resultInput = document.getElementById("latexInput").innerText.toString();
    resultInput = resultInput.replace(/\\dfrac/g, "\\frac"); // replace \dfrac with frac
    resultInput = nerdamer.convertFromLaTeX(resultInput);


    console.log(results[1]);
    console.log(resultInput);
    for (let i = 0; i < results.length; i++){
        if (resultInput.eq(results[i])){
            console.log("correct " + i);
        }
    }

}
