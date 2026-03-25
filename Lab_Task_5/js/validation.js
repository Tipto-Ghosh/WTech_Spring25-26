console.log("Js file connected")

function collect_data(){
    let text = document.getElementById("textInputId").value;
    text = text.trim();

    if(text == ""){
        alert("Not Text are given.")
        return false;
    }

    let totalChars = text.length;
    let all_words = text.split(" ");
    let totalWords = all_words.length;
    // let reverseText = text.split().reverse().join();

    let reverseText = "";
    for(let i = text.length - 1; i >= 0; i--){
        reverseText = reverseText + text[i];
    }

    // console.log("total chars: " , totalChars);
    // console.log("total words: " , totalWords);
    // console.log("reverse Text: " , reverseText);
    
    document.getElementById("totalChars").textContent = "Total Characters: " + totalChars;
    document.getElementById("totalWords").textContent  = "Total Words: " + totalWords;
    document.getElementById("reverseText").textContent = "Reversed Text: " + reverseText;


    return false;
}