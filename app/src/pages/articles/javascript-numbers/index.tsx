import * as React from "react"
import Layout, { SEO } from "../../../templates/layout"
import { NumberTo32Array } from "../../../components/binary"
import { PageMetadata } from "../../../models/index";

export const metadata: PageMetadata = {
    title: 'Inside JavaScript Numbers',
    lang: "en",
    description: "Trying to learn and showcase how Javascript numbers work internally, how to use bitwise operations, and how to represent binary numbers in JS.",
    date: "2024-01-05",
  };

const ArrayTableView = (props: {values: Array<string|number>, withIndexHeader: boolean}) => {
    const [flashColor, setFlashColor] = React.useState("")
    let cols: JSX.Element[] = []
    let header: JSX.Element[] = []
    props.values.forEach((value, index) => {
        cols[index] = <td key={"d-" + index} className="border border-gray-200">{value}</td>
    })
    if (props.withIndexHeader) {
        props.values.forEach((value, index) => {
            header[index] = <th key={"h-" + index} className="border border-gray-200 text-xs italic w-5">{index}</th>
        })
    }

    React.useEffect(() => {
        setFlashColor("rgb(253 230 138)")
        setTimeout(() => {
            setFlashColor("")
        }, 50)
    }, [props.values])

    return (
        <table className="border border-collapse" style={{backgroundColor: flashColor}}>
            { header.length ? <thead><tr>{header}</tr></thead> : ""}
            <tbody>
                <tr>
                    {cols}
                </tr>
                <tr>
                    <td className="text-xs" colSpan={cols.length}><span className="text-left w-12">{"<-"} most significant bits</span></td>
                </tr>
            </tbody>
        </table>
    )
}

export default function Page() {
  return (
    <Layout>
        <h1 className="text-2xl mb-5">Inside JavaScript Numbers <i>(draft)</i></h1>

        <h2 className="text-xl my-2">Numbers internally</h2>
        <NumbersInternallySection />

        <h2 className="text-xl my-2">Binary number syntax</h2>
        <BinaryNumberSyntaxSection />

        <h2 className="text-xl my-2">Bitwise operations</h2>
        <BitwiseOperationsSection />

        <i>"arr1 = new Int32Array([4294967295/2+1])"</i>
        
        <div>
            References:
            <ul>
                <li><a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number#fixed-width_number_conversion">MDN Number</a></li>
                <li><a href="https://brodowsky.it-sky.net/2014/04/04/shift-and-rotation-functions/">Shift- and Rotation Functions</a></li>
                <li><a href="https://brodowsky.it-sky.net/2018/02/16/carry-bit-overflow-bit-and-signed-integers/">Carry Bit, Overflow Bit and Signed Integers</a></li>
                <li><a href="https://en.wikipedia.org/wiki/Two%27s_complement">Two's complement</a></li>
            </ul>
        </div>
    </Layout>
  )
}

export const Head = () => (
    <SEO title={metadata.title} description={metadata.description} lang={metadata.lang} />
)

const BitwiseOperationsSection = () => {
    const [register, setRegister] = React.useState((new Array(32)).fill(0))

    return (
        <div>
            <p>
            As per <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number#fixed-width_number_conversion">MDN: Fixed-width number conversion</a>, 
            "Bitwise operators always convert the operands to 32-bit integers."
            </p>
            <p>Also, there is an article on <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Left_shift">Left Shift on MDN</a>.</p>

        <div className="my-2">
            <i className="text-sm">* The sign at the index 0.</i>
            <ArrayTableView values={register} withIndexHeader={true} />
        </div>

        <ul className="ml-5 list-disc">
            
            <li>
                <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(0b1<<2))}}>0b1 {"<<"} 2</b> = {0b1 << 2/*4*/}
            </li>
            <li>
                <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(0b1<<16))}}>0b1 {"<<"} 16</b> = {0b1 << 16 /*65536*/}
            </li>
            <li>
                <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(0b1<<32))}}>0b1 {"<<"} 32</b> = {0b1 << 32 /*1*/} (in golang - 0, with an error "(32 bits) too small for shift of 32"; 4294967296 in 64bit)
                <ul className="ml-5 list-disc text-gray-400">
                    <li>
                        * in general, signed 32bit integer [-2147483648 to 2147483647]
                    </li>
                    <li>
                    If the left operand is a number with more than 32 bits, it will get the most significant bits discarded.
                    </li>
                    <li>
                    The right operand will be converted to an unsigned 32-bit integer and then taken modulo 32, so the actual shift offset will always be a positive integer between 0 and 31, inclusive. For example, {"100 << 32"} is the same as {"100 << 0"} (and produces 100) because 32 modulo 32 is 0.
                    </li>
                    <li>
                        <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(0b1<<31))}}>0b1 {"<<"} 31</b> = {0b1 << 31/*-2147483648*/}  (would be 2147483648 in 64bit)
                    </li>
                    <li>
                        <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(0b1<<33))}}>0b1 {"<<"} 33</b> = {0b1 << 33/*2*/}
                    </li>
                </ul>
            </li>
            <li>
                <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(0b11111111111111111111111111111111111111111111111111111<<1))}}>0b11111111111111111111111111111111111111111111111111111 {"<<"} 1 (53 bits)</b> = {0b11111111111111111111111111111111111111111111111111111<<1 /*-2*/}
                <ul className="ml-5 list-disc text-gray-400">
                    <li>
                        * If the left operand is a number with more than 32 bits, it will get the most significant bits discarded. 
                    </li>
                    <li>
                        <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(0b1111111111111111111111111111111111111111111111111111<<1))}}>0b1111111111111111111111111111111111111111111111111111 {"<<"} 1 (52 bits)</b> = {0b1111111111111111111111111111111111111111111111111111<<1 /*-2*/}
                    </li>
                    <li>
                        <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(0b11111111111111111111111111111111<<1))}}>0b11111111111111111111111111111111 {"<<"} 1 (32 bits)</b> = {0b11111111111111111111111111111111<<1 /*-2*/}
                    </li>
                    <li>
                        <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(0b1111111111111111111111111111111<<1))}}>0b1111111111111111111111111111111 {"<<"} 1 (31 bits)</b> = {0b1111111111111111111111111111111<<1 /*-2*/}
                    </li>
                    <li>
                        <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(0b111111111111111111111111111111<<1))}}>0b111111111111111111111111111111 {"<<"} 1 (30 bits)</b> = {0b111111111111111111111111111111<<1 /*2147483646*/}
                    </li>
                    <li>
                        <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(-0b1111111111111111111111111111111<<1))}}>-0b1111111111111111111111111111111 {"<<"} 1 (31 bits with a minus)</b> = {-0b1111111111111111111111111111111<<1 /*-2*/} <b>WHY?</b>
                    </li>
                    <li>
                        <b className="underline decoration-dotted" onClick={() => {setRegister(NumberTo32Array(-0b111111111111111111111111111111<<1))}}>-0b111111111111111111111111111111 {"<<"} 1 (30 bits with a minus)</b> = {-0b111111111111111111111111111111<<1 /*2147483646*/} <b>WHY?</b>
                    </li>
                </ul>
            </li>

            <h3>Two's complement</h3>
            ....
        </ul>
        </div>
    )
}
const NumbersInternallySection = () => {
    return (
        <div>
            <p>
            There is an <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/number">article on MDN</a> providing all the info about Numbers in JS.
        </p>
        <div>
            In short: the <i>number</i> represented as a float64, where:
            <ul className="ml-5 list-disc">
                <li>1 bit for the sign</li>
                <li>11 bit for the exonent</li>
                <li>52 bit for the mantissa</li>
            </ul>
        </div>
        <p>
            Min and max integer in this schema: -2<sup>53</sup> + 1 to 2<sup>53</sup> - 1, because the mantissa can only hold 53 bits (including the leading 1).
        </p>
        <p className="mt-2 italic text-sm">
            Number.MIN_SAFE_INTEGER = {Number.MIN_SAFE_INTEGER}
            <br />
            Number.MAX_SAFE_INTEGER = {Number.MAX_SAFE_INTEGER}
        </p>
        </div>
    )
}

const BinaryNumberSyntaxSection = () => {

    return (
        <div>
            <ul className="ml-5 list-disc">
                <li>
                    <b>0b0</b> = {0b0 /*0*/}
                </li>
                <li>
                    <b className="decoration-dashed">0b1</b> = {0b1 /*1*/}
                    <ul className="ml-5 list-disc text-gray-200">
                        <li><b>0b01</b> = {0b01}</li>
                        <li><b>0b001</b> = {0b001}</li>
                    </ul>
                </li>
                <li>
                    <b>0b10</b> = {0b10 /*2*/}
                </li>
                <li>
                    <b>0b11</b> = {0b11 /*3*/}
                </li>
                <li>
                    <b>0b100</b> = {0b100}
                </li>
                <li>
                    <b>0b101</b> = {0b101}
                </li>
                <li>
                    <b>0b110</b> = {0b110}
                </li>
                <li>
                    <b>0b111</b> = {0b111}
                </li>
                <li>
                    ...
                </li>
                <li>
                    up to 53 "1" after "0b" 
                </li>
            </ul>
        </div>
    )
}
