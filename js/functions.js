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
        genitiveQts = {"2":true, "3":true, "4":true},//родительный
        tenExludes = {"11":true, "12":true, "13":true, "14":true};

    var lastDigitOfQty = quantity % 10,
        isExclusive = false;
    //check if is it exclusion
    if (quantity > 10) {
        var exStr = quantity.toString().substr(-2);
        if (tenExludes[exStr]) {
            isExclusive = true;
        }
    }

    if (!isExclusive && nominativeCaseQts[lastDigitOfQty] === true) {
        return nominativeWord;
    } else if (!isExclusive && genitiveQts[lastDigitOfQty] === true) {
        return genitiveSingularWord;
    } else {
        return genitivePluralWord;
    }
}