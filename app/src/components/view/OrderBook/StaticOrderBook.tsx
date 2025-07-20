import { StaticOrderBookProps } from "./types";

// inline-block, if block is needed - wrap it in a div
export const StaticDoMTable = (props: StaticOrderBookProps) => (
    <div className="my-5 inline-block">
        <table>
            <thead>
                <tr>
                    <th className="px-2 py-1">Price</th>
                    <th className="px-2 py-1">Amount</th>
                </tr>
            </thead>
            <tbody>
                {props.sellLevels.map((order, index) => (
                    <tr key={index} className="bg-red-100">
                        <td className="border border-gray-400 px-2 py-1">{order.price}</td>
                        <td className="border border-gray-400 px-2 py-1">{order.amount}</td>
                    </tr>
                ))}
                {props.buyLevels.map((order, index) => (
                    <tr key={index} className="bg-green-100">
                        <td className="border border-gray-400 px-2 py-1">{order.price}</td>
                        <td className="border border-gray-400 px-2 py-1">{order.amount}</td>
                    </tr>
                ))}
            </tbody>
        </table>
    </div>
)