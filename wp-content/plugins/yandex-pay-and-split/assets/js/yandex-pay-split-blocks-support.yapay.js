/******/ (() => { // webpackBootstrap
/******/ 	"use strict";

;// ../../packages/pay-sdk/src/sheet.ts
var PaymentEnv;
(function (PaymentEnv) {
    PaymentEnv["Production"] = "PRODUCTION";
    PaymentEnv["Sandbox"] = "SANDBOX";
})(PaymentEnv || (PaymentEnv = {}));
var CurrencyCode;
(function (CurrencyCode) {
    CurrencyCode["Rub"] = "RUB";
    CurrencyCode["Byn"] = "BYN";
    CurrencyCode["Usd"] = "USD";
    CurrencyCode["Eur"] = "EUR";
    CurrencyCode["Kzt"] = "KZT";
    CurrencyCode["Uah"] = "UAH";
    CurrencyCode["Amd"] = "AMD";
    CurrencyCode["Gel"] = "GEL";
    CurrencyCode["Azn"] = "AZN";
    CurrencyCode["Kgs"] = "KGS";
    CurrencyCode["Gbp"] = "GBP";
    CurrencyCode["Sek"] = "SEK";
    CurrencyCode["Pln"] = "PLN";
    CurrencyCode["Inr"] = "INR";
    CurrencyCode["Czk"] = "CZK";
    CurrencyCode["Cad"] = "CAD";
    CurrencyCode["Brl"] = "BRL";
    CurrencyCode["Aud"] = "AUD";
    CurrencyCode["Uzs"] = "UZS";
    CurrencyCode["Chf"] = "CHF";
    CurrencyCode["Try"] = "TRY";
    CurrencyCode["Cny"] = "CNY";
    CurrencyCode["Zar"] = "ZAR";
    CurrencyCode["Bgn"] = "BGN";
    CurrencyCode["Ron"] = "RON";
    CurrencyCode["Hkd"] = "HKD";
    CurrencyCode["Aed"] = "AED";
})(CurrencyCode || (CurrencyCode = {}));
var CountryCode;
(function (CountryCode) {
    CountryCode["Ru"] = "RU";
    CountryCode["Us"] = "US";
    CountryCode["By"] = "BY";
})(CountryCode || (CountryCode = {}));
var OrderItemType;
(function (OrderItemType) {
    OrderItemType["Pickup"] = "PICKUP";
    OrderItemType["Shipping"] = "SHIPPING";
    OrderItemType["Discount"] = "DISCOUNT";
    OrderItemType["Promocode"] = "PROMOCODE";
})(OrderItemType || (OrderItemType = {}));
var RecurringOptionType;
(function (RecurringOptionType) {
    RecurringOptionType["Recurring"] = "RECURRING";
    RecurringOptionType["Deferred"] = "DEFERRED";
})(RecurringOptionType || (RecurringOptionType = {}));
var PaymentMethodType;
(function (PaymentMethodType) {
    PaymentMethodType["Card"] = "CARD";
    PaymentMethodType["Cash"] = "CASH";
    PaymentMethodType["Split"] = "SPLIT";
})(PaymentMethodType || (PaymentMethodType = {}));
var AllowedAuthMethod;
(function (AllowedAuthMethod) {
    AllowedAuthMethod["CloudToken"] = "CLOUD_TOKEN";
    AllowedAuthMethod["PanOnly"] = "PAN_ONLY";
})(AllowedAuthMethod || (AllowedAuthMethod = {}));
var AllowedCardNetwork;
(function (AllowedCardNetwork) {
    AllowedCardNetwork["AmericanExpress"] = "AMEX";
    AllowedCardNetwork["Discover"] = "DISCOVER";
    AllowedCardNetwork["Jcb"] = "JCB";
    AllowedCardNetwork["Mastercard"] = "MASTERCARD";
    AllowedCardNetwork["Visa"] = "VISA";
    AllowedCardNetwork["VisaElectron"] = "VISAELECTRON";
    AllowedCardNetwork["Maestro"] = "MAESTRO";
    AllowedCardNetwork["Mir"] = "MIR";
    AllowedCardNetwork["UnionPay"] = "UNIONPAY";
    AllowedCardNetwork["Uzcard"] = "UZCARD";
})(AllowedCardNetwork || (AllowedCardNetwork = {}));
var SessionType;
(function (SessionType) {
    SessionType["Token"] = "Token";
    SessionType["Payment"] = "Payment";
    SessionType["Checkout"] = "Checkout";
    SessionType["CheckoutOld"] = "CheckoutOld";
    SessionType["Subscription"] = "Subscription";
    SessionType["ByToken"] = "ByToken";
})(SessionType || (SessionType = {}));

;// ../../packages/pay-sdk/src/button.ts
var ButtonType;
(function (ButtonType) {
    ButtonType["Simple"] = "SIMPLE";
    ButtonType["Pay"] = "PAY";
    ButtonType["Checkout"] = "CHECKOUT";
})(ButtonType || (ButtonType = {}));
var ButtonTheme;
(function (ButtonTheme) {
    ButtonTheme["White"] = "WHITE";
    ButtonTheme["WhiteOutlined"] = "WHITE-OUTLINED";
    ButtonTheme["Black"] = "BLACK";
})(ButtonTheme || (ButtonTheme = {}));
var ButtonWidth;
(function (ButtonWidth) {
    ButtonWidth["Auto"] = "AUTO";
    ButtonWidth["Max"] = "MAX";
    ButtonWidth["MaxImportant"] = "MAX_IMPORTANT";
})(ButtonWidth || (ButtonWidth = {}));
var InnerButtonType;
(function (InnerButtonType) {
    InnerButtonType["Widget"] = "WIDGET";
    InnerButtonType["WidgetUser"] = "WIDGET_USER";
})(InnerButtonType || (InnerButtonType = {}));

;// ../../packages/pay-sdk/index.ts



;// ./browser/blocks-support/ya-pay-blocks-support.ts
const registerBlockPaymentMethod = (paymentMethodType) => {
    var _a, _b, _c;
    const { wc, React, wp } = window;
    const registerPaymentMethod = (_a = wc === null || wc === void 0 ? void 0 : wc.wcBlocksRegistry) === null || _a === void 0 ? void 0 : _a.registerPaymentMethod;
    const { createElement, Fragment } = React;
    const getSetting = (_b = wc === null || wc === void 0 ? void 0 : wc.wcSettings) === null || _b === void 0 ? void 0 : _b.getSetting;
    const decodeEntities = (_c = wp === null || wp === void 0 ? void 0 : wp.htmlEntities) === null || _c === void 0 ? void 0 : _c.decodeEntities;
    if (!getSetting || !decodeEntities || !registerPaymentMethod) {
        return;
    }
    const paymentMethodName = `yandex-pay-and-split-${paymentMethodType.toLocaleLowerCase()}`;
    const settings = getSetting(`${paymentMethodName}_data`, {});
    const label = decodeEntities(settings.title || '');
    const description = decodeEntities(settings.description || '');
    const Content = createElement(() => description, null);
    const Label = createElement((props) => {
        const { PaymentMethodLabel } = props.components;
        const LabelElement = createElement(PaymentMethodLabel, { text: label });
        if (settings.icon) {
            const Icon = createElement('img', { src: settings.icon });
            return createElement(Fragment, {}, LabelElement, Icon);
        }
        return createElement(Fragment, {}, LabelElement);
    }, null);
    registerPaymentMethod({
        name: paymentMethodName,
        label: Label,
        content: Content,
        edit: Content,
        canMakePayment: () => true,
        ariaLabel: label,
        supports: {
            features: settings.supports || [],
        },
    });
};

;// ./browser/blocks-support/ya-pay-split.ts


registerBlockPaymentMethod(PaymentMethodType.Split);

/******/ })()
;