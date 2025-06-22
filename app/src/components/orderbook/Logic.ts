export interface Order {
    isBid: boolean; // side: true for bid, false for ask, bid - buy, ask - sell
    price: number;
    quantity: number;
    sequence: number;
}

export const placeOrder = (orders: Order[], order: Order): Order[] => {
    let biggestSequence = 0
    for (let i = 0; i < orders.length; i++) {
        if (orders[i].sequence > biggestSequence) {
            biggestSequence = orders[i].sequence
        }
    }

    order.sequence = biggestSequence + 1
    orders.push(order)

    return orders
}

export const updateOrder = (orders: Order[], order: Order): Order[] => {
    for (let i = 0; i < orders.length; i++) {
        if (orders[i].sequence > order.sequence) {
            orders[i] = order   
        }
    }

    return orders
}

export const removeOrder = (orders: Order[], sequence: number): Order[] => {
    for (let i = 0; i < orders.length; i++) {
        if (orders[i].sequence == sequence) {
            orders.splice(i, 1)
        }
    }

    return orders
}

export const matchAndExecuteOrders = (orders: Order[]): Order[] => {
    let bids: Order[] = [];
    let asks: Order[] = [];
    for (let i = 0; i < orders.length; i++) {
        if (orders[i].isBid) {
            bids.push(orders[i]);
        } else {
            asks.push(orders[i]);
        }
    }
    bids.sort((a, b) => b.price - a.price); // sort bids (buy) by price descending
    asks.sort((a, b) => a.price - b.price); // sort asks (sell) by price ascending

    if (bids.length === 0 || asks.length === 0) {
        return orders; // no matching orders
    }

    if (bids[0].price < asks[0].price) {
        return orders; // no matching price
    } 
    
    if (bids[0].price >= asks[0].price) {
        // Match orders
        let matchedQuantity = Math.min(bids[0].quantity, asks[0].quantity);
        bids[0].quantity -= matchedQuantity;
        asks[0].quantity -= matchedQuantity;

        // Remove executed orders
        if (bids[0].quantity === 0) {
            orders = removeOrder(orders, bids[0].sequence);
        }
        if (asks[0].quantity === 0) {
            orders = removeOrder(orders, asks[0].sequence);
        }
    }


    return orders
}