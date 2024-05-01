const a = 0b00000000000000000000000000000000;
export const And32 = (aInt32: number, bInt32: number): number => {
    let arr = new Int32Array(1)
    arr[0] = aInt32
    const a = arr[0]
    arr[0] = bInt32
    const b = arr[0]

    arr[0] = a & b

    console.log(getBits(arr[0]))

    return arr[0]
}


function getBits(value: number) {
    var base2_ = (value).toString(2).split("").reverse().join("");
    var baseL_ = new Array(32 - base2_.length).fill(0).join("");
    var base2 = base2_ + baseL_;

    return base2;
}

export const Or32 = (aInt32: number, bInt32: number): number => {
    let arr = new Int32Array(1)
    arr[0] = aInt32
    const a = arr[0]
    arr[0] = bInt32
    const b = arr[0]

    arr[0] = a | b

    return arr[0]
}