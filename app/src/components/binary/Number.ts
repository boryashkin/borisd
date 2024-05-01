
export const NumberTo32Array = (number: number): Array<number> => {
    let arr = new Array(32).fill(0);
    if (number < 0) {
        arr[0] = 1;
        number = number == 0b1 << 31 ? -((0b1 << 31)+1) : -number;
    }

    (number).toString(2).split("").reverse().forEach((value, index) => {
        arr[31-index] = value
    });

    
    return arr
}