import * as React from "react"
import Layout from "../../../components/layout"

const parityBitPositions = (n: number): number[] => {
    let multipliers: number[] = []

    let binArr = n.toString(2).split("").reverse().map<number>((v: string, index: number, arr: string[]): number => {
        return parseInt(v) == 0 ? 0 : 1;
    })

    for (let i = binArr.length - 1; i >= 0; i--) {
        if (binArr[i] == 1) {
            multipliers.push(2 ** i)
        }
    }

    return multipliers
}

interface errorPosition {
    overallParityValid: boolean,
    singleErrorPosition: number,
}

const getErrorPosition = (pm: number[]): errorPosition => {
    let pm0: number[] = []

    pm.forEach((value: number, index: number) => {
        if (value == 1) {
            pm0.push(index)
        }
    })

    let errPos = pm0.reduce((pv: number, cv: number, ci: number, array: number[]): number => {
        return pv ^ cv
    })

    return {overallParityValid: pm0.length % 2 == 0 && errPos != 0, singleErrorPosition: errPos}
}

const decodeHamming1511 = (pm: number[]): number[] => {
    let m: number[] = []

    for (let i = 1; i < pm.length; i++) {
        if (parityCheckPlaces1511.includes(i)) {
            continue
        }

        m.push(pm[i])
    }

    return m
}

const arrayToSymbol = (n: number[]): string => {
    let charCode = n.reduce((pv: number, cv: number, ci: number, array: number[]): number => {
        return (pv << 1) + (cv & 0xFF);
    })

    return String.fromCharCode(charCode)
}

const symbolToArray = (n: string): number[] => {
    let symbols = n.charCodeAt(0).toString(2).split("")

    return symbols.map<number>((v: string, index: number, arr: string[]): number => {
        return parseInt(v) == 0 ? 0 : 1;
    })
}

const encodeHamming1511 = (m: number[]): number[] => {
    let parity = getParity(m.length)
    let pm: number[] = [0]
    let toCheck: number[][] = []

    for (let i = 0; i < parity; i++) {
        pm[parityCheckPlaces1511[i]] = 0
        toCheck[parityCheckPlaces1511[i]] = []
    }

    for (let i = 0; i < m.length; i++) {
        let k = i;
        
        while (typeof pm[k] !== 'undefined') {
            k++
        }

        pm[k] = m[i]
    }

    pm.forEach((_: number, i: number) => {
        if (i == 0) {
            return
        }

        let positions = parityBitPositions(i)
        positions.forEach((value: number) => {
            toCheck[value].push(i)
        })
    })

    toCheck.forEach((value: number[], index: number) => {
        let cnt = 0
        value.forEach((pos: number) => {
            if (pm[pos] == 1) {
                cnt++
            }
        })
        
        pm[index] = ((cnt % 2) == 0) ? 0 : 1
    })

    let totalParityCnt = 0

    for (let i = 1; i < pm.length; i++) {
        if (pm[i] == 1) {
            totalParityCnt++
        }
    }

    pm[0] = (totalParityCnt % 2) == 0 ? 0 : 1

    return pm
}

const Hamming1511 = (props: {value: string}) => {
    const [cells, setCells] = React.useState(encodeHamming1511(symbolToArray(props.value)));
    const cellUpdate = (i: number, v: number) => {
        setCells((state) => {
            state[i] = v == 0 ? 0 : 1

            return [...state]
        })
    }

    React.useEffect(() => {
        setCells(encodeHamming1511(symbolToArray(props.value)))
      }, [props.value]);

    const createCellObjects = (arr: number[]) => {
        return arr.map((value: number, index: number, array: number[]) => {
            return <Cell key={index} idx={index} number={value == 0 ? 0 : 1} onChange={(e) => { cellUpdate(index, parseInt(e.target.value)) }} />
        })
    }

    const errPos = getErrorPosition(cells)

    return (
        <>
            <div>
                {createCellObjects(cells)}
                <div><i>⬆️ change bits to affect decoding</i></div>
            </div>
            <div className="mt-3">
                Decoded data: <b>{arrayToSymbol(decodeHamming1511(cells))}</b>
            </div>
            <div>
                Checks: Error position: <b><i>{errPos.singleErrorPosition}</i></b>; More than one error: <b><i>{errPos.overallParityValid ? "true" : "false"}</i></b>.
            </div>
            <div className="text-sm"><i>decoded data based only on your bits</i></div>
        </>
    )
}

const parityCheckPlaces1511 = [1, 2, 4, 8, 16, 32, 64, 128];

const Cell = (props: { idx: number, number: number, onChange: (event: React.ChangeEvent<HTMLInputElement>) => void }) => {
    const bgColor = parityCheckPlaces1511.includes(props.idx) ? "bg-emerald-200" : (props.idx == 0 ? "bg-gray-200" : "")


    return (<>
    {props.idx % 4 == 0 && <br/>}
    <input className={bgColor + " border border-emerald-500 bg-"} type="number" min="0" max="1" value={props.number} onChange={props.onChange} />
    </>
    
    )
}

const getParity = (m: number): number => {
    let p = 1
    let maxIterations = 100
    while (m > (2 ** p - p - 1) && maxIterations-- > 0) {
        p++
    }

    if (maxIterations == 0) {
        console.error("too many iterations")
    }

    return p
};

const ParityCalculator = () => {
    const [p, setP] = React.useState(1)
    // 2^p >= p + m + 1
    // m <= 2^p - p - 1

    const calcP = (m: number) => {
        setP(() => {
            return getParity(m)
        })
    }

    return (
        <>
            <b>m = </b><input className="border border-neutral-200" name="m" placeholder="m" type="number" min={1} max={256} onChange={(e) => { calcP(parseInt(e.target.value)) }}></input> <i>⬅️ enter "m"</i>
            <div>
                <b>p = </b> {p}
            </div>
        </>
    )
}

export default function Page() {
    const [currentData, setCurrentData] = React.useState("H")
    const currentDataBin = currentData.charCodeAt(0).toString(2)
    const numberOfDataBits = currentDataBin.length
    const numberOfParityBits = getParity(numberOfDataBits)

    return (
        <Layout>
            <h1 className="mb-10">Hamming Code visualisation</h1>
            <p className="mb-10">
                m - number of data bits.<br />
                p - number of parity check bits.<br />

                1. (p + m) - any of bits can be corrupted.<br />
                2. 1 - None of bits are corrupted.<br />
                Formula for a number of parity bits per data: {"2^p >= p + m + 1"}<br />
            </p>
            <div className="mb-5">
                <ParityCalculator />
            </div>
            <div>
                <p className="mb-5">
                    Position of parity bits = 2^n (or 1, 2, 4, 8, 16, 32, 64, 128...).
                </p>
                <b>Example</b>
                <div>Input Data: "<input className="w-5 border border-neutral-200" value={currentData} type="text" minLength={1} maxLength={1} onChange={(e) => { setCurrentData(e.target.value) }} />" <i>⬅️ enter "data"</i></div>
                <div className="text-sm">About the data: <i>"{currentDataBin}", data bits: {numberOfDataBits}, <span className="text-emerald-500">parity bits</span>: {numberOfParityBits}</i>, <span className="text-gray-500">overall parity bits</span>: 1</div>
                <div className="mb-3"></div>
                <Hamming1511 value={currentData}/>
            </div>
            <div className="mt-10 text-sm">
            Learn more on YouTube <a href="https://www.youtube.com/watch?v=X8jsijhllIA">"But what are Hamming codes? The origin of error correction" by 3Blue1Brown</a>
            </div>
        </Layout>
    )
}