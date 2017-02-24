function readTextFile(file, callback)
{
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}

function declensionForNumber(nominativeWord, genitiveSingularWord, genitivePluralWord, quantity)
{
    var nominativeCaseQts = {"1":true},//именительный
        genitiveQts = {"2":true, "3":true, "4":true};//родительный

    var lastDigitOfQty = quantity % 10;

    if (quantity != 11 && nominativeCaseQts[lastDigitOfQty] === true) {
        return nominativeWord;
    } else if ((quantity < 11 || quantity > 20)&& genitiveQts[lastDigitOfQty] === true) {
        return genitiveSingularWord;
    } else {
        return genitivePluralWord;
    }
}