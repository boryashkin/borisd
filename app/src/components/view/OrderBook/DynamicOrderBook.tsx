import { useState } from "react";
import { StaticDoMTable } from "./StaticOrderBook";
import { DynamicOrderBookProps, PriceLevel } from "./types";
import { Order, matchAndExecuteOrders, placeOrder, removeOrder, updateOrder } from "../../orderbook/Logic";

export const DynamicOrderBook = (props: DynamicOrderBookProps) => {
    const [orders, setOrders] = useState(props.initialOrders.map((order, i, arr) => {
        order.sequence = i-1 >= 0 ? arr[i-1].sequence + 1 : 0

        return order
    }));

    const onAddOrder = (order: Order) => {
        console.log("Adding order:", orders);
        setOrders(prev => [...matchAndExecuteOrders(placeOrder(prev, order))]);
    };
    
    const onUpdateOrder = (order: Order) => {
        setOrders(prev => [...matchAndExecuteOrders(updateOrder(prev, order))]);
    };

    const onRemoveOrder = (sequence: number) => {
        setOrders(prev => [...matchAndExecuteOrders(removeOrder(prev, sequence))]);
    };

    let buyLevels: PriceLevel[] = [];
    let sellLevels: PriceLevel[] = [];

    orders.forEach(order => {
        let levels: PriceLevel[] = buyLevels;
        if (order.isBid) {
            levels = buyLevels;
        } else {
            levels = sellLevels;
        }

        const existingLevel = levels.find(level => level.price === order.price);
        if (existingLevel) {
            existingLevel.amount += order.quantity;
        } else {
            levels.push({ price: order.price, amount: order.quantity });
        }

        if (order.isBid) {
            buyLevels = levels;
        } else {
            sellLevels = levels;
        }
    });

    buyLevels.sort((a, b) => b.price - a.price);
    sellLevels.sort((a, b) => b.price - a.price);

    return (
        <>
            <StaticDoMTable
                buyLevels={buyLevels}
                sellLevels={sellLevels}
            />
            {props.children?.({
                onAddOrder: onAddOrder,
                onRemoveOrder: onRemoveOrder,
                onUpdateOrder: onUpdateOrder,
            })}
        </>
    )
}