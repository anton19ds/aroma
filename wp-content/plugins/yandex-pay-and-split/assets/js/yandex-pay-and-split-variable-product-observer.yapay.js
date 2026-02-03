/******/ (() => { // webpackBootstrap
/******/ 	"use strict";

;// ./browser/lib/utils/sequence.ts
function sequence(...methods) {
    return (...args) => {
        methods.forEach((method) => method(...args));
    };
}

;// ./browser/lib/utils/map-default.ts
class MapWithDefault extends Map {
    get(key) {
        var _a;
        return (_a = super.get(key)) !== null && _a !== void 0 ? _a : this.defaultValue;
    }
    constructor(defaultValue, entries) {
        super(entries);
        this.defaultValue = defaultValue;
    }
}

;// ./browser/lib/utils/map-default-number.ts

class MapDefaultNumber extends MapWithDefault {
    constructor(entries) {
        super(0, entries);
    }
}

;// ./browser/lib/utils/index.ts



;// ../../packages/utils/src/ensure/ensure.ts
function ensure_ensure(entity, error) {
    if (entity == null) {
        throw new Error(error.message);
    }
    return entity;
}

;// ../../packages/pay-cms/src/ya-pay-state/errors.ts
const EMPTY_STATE_ERROR = 'No state. You have to set state.';

;// ../../packages/pay-cms/src/ya-pay-state/ya-pay-state-base.ts


class BaseYaPayState {
    constructor() {
        this.state = null;
    }
    value() {
        return ensure_ensure(this.state, { message: EMPTY_STATE_ERROR });
    }
    hasValue() {
        return this.state !== null;
    }
    set(state) {
        this.state = state;
    }
    update(state) {
        if (this.state) {
            this.mergeState(this.state, state);
        }
    }
}

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
var sheet_SessionType;
(function (SessionType) {
    SessionType["Token"] = "Token";
    SessionType["Payment"] = "Payment";
    SessionType["Checkout"] = "Checkout";
    SessionType["CheckoutOld"] = "CheckoutOld";
    SessionType["Subscription"] = "Subscription";
    SessionType["ByToken"] = "ByToken";
})(sheet_SessionType || (sheet_SessionType = {}));

;// ../../packages/pay-sdk/src/button.ts
var button_ButtonType;
(function (ButtonType) {
    ButtonType["Simple"] = "SIMPLE";
    ButtonType["Pay"] = "PAY";
    ButtonType["Checkout"] = "CHECKOUT";
})(button_ButtonType || (button_ButtonType = {}));
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



;// ../../packages/pay-cms/src/ya-pay-button/ya-pay-button.ts


class YaPayButton {
    constructor(session) {
        this.session = session;
    }
    mount(container, _a) {
        return __awaiter(this, void 0, void 0, function* () {
            var { kind } = _a, params = __rest(_a, ["kind"]);
            try {
                const session = yield this.session.instance();
                session.unmountButton(container);
                const options = Object.assign(Object.assign({}, params), { type: ButtonType.Pay });
                if (kind === 'submit') {
                    session.mountSubmitButton(container, options);
                }
                else {
                    session.mountButton(container, options);
                }
            }
            catch (error) {
                console.error(error);
            }
        });
    }
    unmount(container) {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                const session = yield this.session.instance();
                session.unmountButton(container);
            }
            catch (error) {
                console.error(error);
            }
        });
    }
}

;// ../../packages/pay-cms/src/ya-pay-button/index.ts


;// ../../packages/pay-sdk/src/payment.ts
var payment_SdkSourcePage;
(function (SdkSourcePage) {
    SdkSourcePage["Product"] = "product";
    SdkSourcePage["Cart"] = "cart";
    SdkSourcePage["Checkout"] = "checkout";
    SdkSourcePage["Cms"] = "cms";
})(payment_SdkSourcePage || (payment_SdkSourcePage = {}));
var PaymentEventType;
(function (PaymentEventType) {
    PaymentEventType["Ready"] = "ready";
    PaymentEventType["Abort"] = "abort";
    PaymentEventType["Error"] = "error";
    PaymentEventType["Process"] = "process";
    PaymentEventType["Ping"] = "ping";
    PaymentEventType["Change"] = "change";
    PaymentEventType["Reset"] = "reset";
    PaymentEventType["Setup"] = "setup";
    PaymentEventType["Success"] = "success";
    PaymentEventType["NativeInitialize"] = "nativeInitialize";
})(PaymentEventType || (PaymentEventType = {}));
var AbortEventReason;
(function (AbortEventReason) {
    AbortEventReason["Close"] = "CLOSE";
    AbortEventReason["Timeout"] = "TIMEOUT";
    AbortEventReason["ManualClose"] = "MANUAL_CLOSE";
})(AbortEventReason || (AbortEventReason = {}));

;// ../../packages/pay-cms/src/ya-pay-session/ya-pay-session.ts




class YaPaySession {
    constructor(sdk, callbacks) {
        this.sdk = sdk;
        this.callbacks = callbacks;
        this.session = null;
        this.params = new YaPayState();
    }
    instance() {
        return __awaiter(this, void 0, void 0, function* () {
            if (!this.session) {
                const sdk = yield this.sdk.instance();
                const data = Object.assign(Object.assign({}, this.params.value()), { version: 4, type: SessionType.ByToken });
                this.session = yield sdk.createSession(data, {
                    source: SdkSourcePage.Cms,
                    onPayButtonClick: this.callbacks.onPayButtonClick,
                    onFormOpenError: (reason) => console.error(reason),
                });
            }
            return this.session;
        });
    }
    /**
     * Так как здесь меняются все параметры,
     * необходимо занулять сессиию и в "instance" создается новая
     *
     * TODO: Надо бы придумать маршрут удачнее, но только в рамках класса
     */
    set(params) {
        return __awaiter(this, void 0, void 0, function* () {
            var _a;
            (_a = this.session) === null || _a === void 0 ? void 0 : _a.destroy();
            this.session = null;
            this.params.set(params);
        });
    }
    /**
     * Здесь обновляем только то, что умеет обновлять метод "update" сессии
     */
    update(params) {
        return __awaiter(this, void 0, void 0, function* () {
            var _a;
            (_a = this.session) === null || _a === void 0 ? void 0 : _a.update(() => params);
            this.params.update(params);
        });
    }
}

;// ../../packages/pay-cms/src/ya-pay-session/index.ts


;// ../../packages/pay-cms/index.ts









;// ./browser/lib/observer/event-state.ts

class EventState extends BaseYaPayState {
    update(state) {
        super.update(state);
        this.dispatchEvent(state);
    }
    trigger() {
        this.dispatchEvent();
    }
    subscribe(observer) {
        document.addEventListener(this.getEventName(), (event) => {
            if (!(event instanceof CustomEvent)) {
                return;
            }
            // eslint-disable-next-line @typescript-eslint/no-unsafe-type-assertion
            const detail = event.detail;
            observer(detail.state, detail.delta);
        });
    }
    dispatchEvent(delta) {
        if (this.state === null) {
            return;
        }
        document.dispatchEvent(new CustomEvent(this.getEventName(), {
            detail: {
                state: this.state,
                delta,
            },
        }));
    }
}

;// ./browser/lib/observer/value.ts
class Value {
    constructor(valueState) {
        this.valueState = valueState;
    }
    get value() {
        return this.valueState;
    }
    set value(value) {
        this.valueState = value;
    }
    join(delta) {
        this.value = delta.value;
    }
}

;// ./browser/lib/observer/value-default.ts

class ValueWithDefault extends Value {
    constructor(value, defaultValue) {
        super(value);
        this.defaultValue = defaultValue;
    }
    get value() {
        const value = super.value;
        return value === 0 ? this.defaultValue : value;
    }
    set value(value) {
        super.value = value;
    }
}

;// ./browser/lib/observer/index.ts




;// ./browser/single-product/states/amount.ts

class ProductAmountEventState extends EventState {
    getEventName() {
        return 'yandex_pay_product_amount_update';
    }
    mergeState(state, deltaState) {
        state.join(deltaState);
    }
}
const amountState = new ProductAmountEventState();

;// ./browser/single-product/states/variation.ts

class VariationEventState extends EventState {
    getEventName() {
        return 'yandex_pay_variation_selected';
    }
    mergeState(state, deltaState) {
        state.value = deltaState.value;
    }
}
const variationState = new VariationEventState();

;// ./browser/single-product/states/quantity.ts

class QuantityEventState extends EventState {
    getEventName() {
        return 'yandex_pay_quantity_changes';
    }
    mergeState(state, deltaState) {
        for (const [productId, quantity] of deltaState.value) {
            state.value.set(productId, quantity);
        }
    }
}
const quantityState = new QuantityEventState();

;// ./browser/single-product/states/price.ts

class PriceEventState extends EventState {
    getEventName() {
        return 'yandex_pay_price_changes';
    }
    mergeState(state, deltaState) {
        for (const [productId, quantity] of deltaState.value) {
            state.value.set(productId, quantity);
        }
    }
}
const priceState = new PriceEventState();

;// ./browser/single-product/states/index.ts





;// ../../packages/utils/src/debounce/debounce.ts
// eslint-disable-next-line @typescript-eslint/no-explicit-any
function debounce(func, wait) {
    let timeout = null;
    return function (...parameters) {
        if (timeout) {
            clearTimeout(timeout);
        }
        timeout = setTimeout(() => func.apply(this, parameters), wait);
    };
}

;// ../../node_modules/tslib/tslib.es6.mjs
/******************************************************************************
Copyright (c) Microsoft Corporation.

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
PERFORMANCE OF THIS SOFTWARE.
***************************************************************************** */
/* global Reflect, Promise, SuppressedError, Symbol, Iterator */

var extendStatics = function(d, b) {
  extendStatics = Object.setPrototypeOf ||
      ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
      function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
  return extendStatics(d, b);
};

function __extends(d, b) {
  if (typeof b !== "function" && b !== null)
      throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
  extendStatics(d, b);
  function __() { this.constructor = d; }
  d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
}

var __assign = function() {
  __assign = Object.assign || function __assign(t) {
      for (var s, i = 1, n = arguments.length; i < n; i++) {
          s = arguments[i];
          for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
      }
      return t;
  }
  return __assign.apply(this, arguments);
}

function tslib_es6_rest(s, e) {
  var t = {};
  for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p) && e.indexOf(p) < 0)
      t[p] = s[p];
  if (s != null && typeof Object.getOwnPropertySymbols === "function")
      for (var i = 0, p = Object.getOwnPropertySymbols(s); i < p.length; i++) {
          if (e.indexOf(p[i]) < 0 && Object.prototype.propertyIsEnumerable.call(s, p[i]))
              t[p[i]] = s[p[i]];
      }
  return t;
}

function __decorate(decorators, target, key, desc) {
  var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
  if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
  else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
  return c > 3 && r && Object.defineProperty(target, key, r), r;
}

function __param(paramIndex, decorator) {
  return function (target, key) { decorator(target, key, paramIndex); }
}

function __esDecorate(ctor, descriptorIn, decorators, contextIn, initializers, extraInitializers) {
  function accept(f) { if (f !== void 0 && typeof f !== "function") throw new TypeError("Function expected"); return f; }
  var kind = contextIn.kind, key = kind === "getter" ? "get" : kind === "setter" ? "set" : "value";
  var target = !descriptorIn && ctor ? contextIn["static"] ? ctor : ctor.prototype : null;
  var descriptor = descriptorIn || (target ? Object.getOwnPropertyDescriptor(target, contextIn.name) : {});
  var _, done = false;
  for (var i = decorators.length - 1; i >= 0; i--) {
      var context = {};
      for (var p in contextIn) context[p] = p === "access" ? {} : contextIn[p];
      for (var p in contextIn.access) context.access[p] = contextIn.access[p];
      context.addInitializer = function (f) { if (done) throw new TypeError("Cannot add initializers after decoration has completed"); extraInitializers.push(accept(f || null)); };
      var result = (0, decorators[i])(kind === "accessor" ? { get: descriptor.get, set: descriptor.set } : descriptor[key], context);
      if (kind === "accessor") {
          if (result === void 0) continue;
          if (result === null || typeof result !== "object") throw new TypeError("Object expected");
          if (_ = accept(result.get)) descriptor.get = _;
          if (_ = accept(result.set)) descriptor.set = _;
          if (_ = accept(result.init)) initializers.unshift(_);
      }
      else if (_ = accept(result)) {
          if (kind === "field") initializers.unshift(_);
          else descriptor[key] = _;
      }
  }
  if (target) Object.defineProperty(target, contextIn.name, descriptor);
  done = true;
};

function __runInitializers(thisArg, initializers, value) {
  var useValue = arguments.length > 2;
  for (var i = 0; i < initializers.length; i++) {
      value = useValue ? initializers[i].call(thisArg, value) : initializers[i].call(thisArg);
  }
  return useValue ? value : void 0;
};

function __propKey(x) {
  return typeof x === "symbol" ? x : "".concat(x);
};

function __setFunctionName(f, name, prefix) {
  if (typeof name === "symbol") name = name.description ? "[".concat(name.description, "]") : "";
  return Object.defineProperty(f, "name", { configurable: true, value: prefix ? "".concat(prefix, " ", name) : name });
};

function __metadata(metadataKey, metadataValue) {
  if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(metadataKey, metadataValue);
}

function tslib_es6_awaiter(thisArg, _arguments, P, generator) {
  function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
  return new (P || (P = Promise))(function (resolve, reject) {
      function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
      function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
      function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
      step((generator = generator.apply(thisArg, _arguments || [])).next());
  });
}

function __generator(thisArg, body) {
  var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g = Object.create((typeof Iterator === "function" ? Iterator : Object).prototype);
  return g.next = verb(0), g["throw"] = verb(1), g["return"] = verb(2), typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
  function verb(n) { return function (v) { return step([n, v]); }; }
  function step(op) {
      if (f) throw new TypeError("Generator is already executing.");
      while (g && (g = 0, op[0] && (_ = 0)), _) try {
          if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
          if (y = 0, t) op = [op[0] & 2, t.value];
          switch (op[0]) {
              case 0: case 1: t = op; break;
              case 4: _.label++; return { value: op[1], done: false };
              case 5: _.label++; y = op[1]; op = [0]; continue;
              case 7: op = _.ops.pop(); _.trys.pop(); continue;
              default:
                  if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                  if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                  if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                  if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                  if (t[2]) _.ops.pop();
                  _.trys.pop(); continue;
          }
          op = body.call(thisArg, _);
      } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
      if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
  }
}

var __createBinding = Object.create ? (function(o, m, k, k2) {
  if (k2 === undefined) k2 = k;
  var desc = Object.getOwnPropertyDescriptor(m, k);
  if (!desc || ("get" in desc ? !m.__esModule : desc.writable || desc.configurable)) {
      desc = { enumerable: true, get: function() { return m[k]; } };
  }
  Object.defineProperty(o, k2, desc);
}) : (function(o, m, k, k2) {
  if (k2 === undefined) k2 = k;
  o[k2] = m[k];
});

function __exportStar(m, o) {
  for (var p in m) if (p !== "default" && !Object.prototype.hasOwnProperty.call(o, p)) __createBinding(o, m, p);
}

function __values(o) {
  var s = typeof Symbol === "function" && Symbol.iterator, m = s && o[s], i = 0;
  if (m) return m.call(o);
  if (o && typeof o.length === "number") return {
      next: function () {
          if (o && i >= o.length) o = void 0;
          return { value: o && o[i++], done: !o };
      }
  };
  throw new TypeError(s ? "Object is not iterable." : "Symbol.iterator is not defined.");
}

function __read(o, n) {
  var m = typeof Symbol === "function" && o[Symbol.iterator];
  if (!m) return o;
  var i = m.call(o), r, ar = [], e;
  try {
      while ((n === void 0 || n-- > 0) && !(r = i.next()).done) ar.push(r.value);
  }
  catch (error) { e = { error: error }; }
  finally {
      try {
          if (r && !r.done && (m = i["return"])) m.call(i);
      }
      finally { if (e) throw e.error; }
  }
  return ar;
}

/** @deprecated */
function __spread() {
  for (var ar = [], i = 0; i < arguments.length; i++)
      ar = ar.concat(__read(arguments[i]));
  return ar;
}

/** @deprecated */
function __spreadArrays() {
  for (var s = 0, i = 0, il = arguments.length; i < il; i++) s += arguments[i].length;
  for (var r = Array(s), k = 0, i = 0; i < il; i++)
      for (var a = arguments[i], j = 0, jl = a.length; j < jl; j++, k++)
          r[k] = a[j];
  return r;
}

function __spreadArray(to, from, pack) {
  if (pack || arguments.length === 2) for (var i = 0, l = from.length, ar; i < l; i++) {
      if (ar || !(i in from)) {
          if (!ar) ar = Array.prototype.slice.call(from, 0, i);
          ar[i] = from[i];
      }
  }
  return to.concat(ar || Array.prototype.slice.call(from));
}

function __await(v) {
  return this instanceof __await ? (this.v = v, this) : new __await(v);
}

function __asyncGenerator(thisArg, _arguments, generator) {
  if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
  var g = generator.apply(thisArg, _arguments || []), i, q = [];
  return i = Object.create((typeof AsyncIterator === "function" ? AsyncIterator : Object).prototype), verb("next"), verb("throw"), verb("return", awaitReturn), i[Symbol.asyncIterator] = function () { return this; }, i;
  function awaitReturn(f) { return function (v) { return Promise.resolve(v).then(f, reject); }; }
  function verb(n, f) { if (g[n]) { i[n] = function (v) { return new Promise(function (a, b) { q.push([n, v, a, b]) > 1 || resume(n, v); }); }; if (f) i[n] = f(i[n]); } }
  function resume(n, v) { try { step(g[n](v)); } catch (e) { settle(q[0][3], e); } }
  function step(r) { r.value instanceof __await ? Promise.resolve(r.value.v).then(fulfill, reject) : settle(q[0][2], r); }
  function fulfill(value) { resume("next", value); }
  function reject(value) { resume("throw", value); }
  function settle(f, v) { if (f(v), q.shift(), q.length) resume(q[0][0], q[0][1]); }
}

function __asyncDelegator(o) {
  var i, p;
  return i = {}, verb("next"), verb("throw", function (e) { throw e; }), verb("return"), i[Symbol.iterator] = function () { return this; }, i;
  function verb(n, f) { i[n] = o[n] ? function (v) { return (p = !p) ? { value: __await(o[n](v)), done: false } : f ? f(v) : v; } : f; }
}

function __asyncValues(o) {
  if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
  var m = o[Symbol.asyncIterator], i;
  return m ? m.call(o) : (o = typeof __values === "function" ? __values(o) : o[Symbol.iterator](), i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () { return this; }, i);
  function verb(n) { i[n] = o[n] && function (v) { return new Promise(function (resolve, reject) { v = o[n](v), settle(resolve, reject, v.done, v.value); }); }; }
  function settle(resolve, reject, d, v) { Promise.resolve(v).then(function(v) { resolve({ value: v, done: d }); }, reject); }
}

function __makeTemplateObject(cooked, raw) {
  if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
  return cooked;
};

var __setModuleDefault = Object.create ? (function(o, v) {
  Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
  o["default"] = v;
};

var ownKeys = function(o) {
  ownKeys = Object.getOwnPropertyNames || function (o) {
    var ar = [];
    for (var k in o) if (Object.prototype.hasOwnProperty.call(o, k)) ar[ar.length] = k;
    return ar;
  };
  return ownKeys(o);
};

function __importStar(mod) {
  if (mod && mod.__esModule) return mod;
  var result = {};
  if (mod != null) for (var k = ownKeys(mod), i = 0; i < k.length; i++) if (k[i] !== "default") __createBinding(result, mod, k[i]);
  __setModuleDefault(result, mod);
  return result;
}

function __importDefault(mod) {
  return (mod && mod.__esModule) ? mod : { default: mod };
}

function __classPrivateFieldGet(receiver, state, kind, f) {
  if (kind === "a" && !f) throw new TypeError("Private accessor was defined without a getter");
  if (typeof state === "function" ? receiver !== state || !f : !state.has(receiver)) throw new TypeError("Cannot read private member from an object whose class did not declare it");
  return kind === "m" ? f : kind === "a" ? f.call(receiver) : f ? f.value : state.get(receiver);
}

function __classPrivateFieldSet(receiver, state, value, kind, f) {
  if (kind === "m") throw new TypeError("Private method is not writable");
  if (kind === "a" && !f) throw new TypeError("Private accessor was defined without a setter");
  if (typeof state === "function" ? receiver !== state || !f : !state.has(receiver)) throw new TypeError("Cannot write private member to an object whose class did not declare it");
  return (kind === "a" ? f.call(receiver, value) : f ? f.value = value : state.set(receiver, value)), value;
}

function __classPrivateFieldIn(state, receiver) {
  if (receiver === null || (typeof receiver !== "object" && typeof receiver !== "function")) throw new TypeError("Cannot use 'in' operator on non-object");
  return typeof state === "function" ? receiver === state : state.has(receiver);
}

function __addDisposableResource(env, value, async) {
  if (value !== null && value !== void 0) {
    if (typeof value !== "object" && typeof value !== "function") throw new TypeError("Object expected.");
    var dispose, inner;
    if (async) {
      if (!Symbol.asyncDispose) throw new TypeError("Symbol.asyncDispose is not defined.");
      dispose = value[Symbol.asyncDispose];
    }
    if (dispose === void 0) {
      if (!Symbol.dispose) throw new TypeError("Symbol.dispose is not defined.");
      dispose = value[Symbol.dispose];
      if (async) inner = dispose;
    }
    if (typeof dispose !== "function") throw new TypeError("Object not disposable.");
    if (inner) dispose = function() { try { inner.call(this); } catch (e) { return Promise.reject(e); } };
    env.stack.push({ value: value, dispose: dispose, async: async });
  }
  else if (async) {
    env.stack.push({ async: true });
  }
  return value;
}

var _SuppressedError = typeof SuppressedError === "function" ? SuppressedError : function (error, suppressed, message) {
  var e = new Error(message);
  return e.name = "SuppressedError", e.error = error, e.suppressed = suppressed, e;
};

function __disposeResources(env) {
  function fail(e) {
    env.error = env.hasError ? new _SuppressedError(e, env.error, "An error was suppressed during disposal.") : e;
    env.hasError = true;
  }
  var r, s = 0;
  function next() {
    while (r = env.stack.pop()) {
      try {
        if (!r.async && s === 1) return s = 0, env.stack.push(r), Promise.resolve().then(next);
        if (r.dispose) {
          var result = r.dispose.call(r.value);
          if (r.async) return s |= 2, Promise.resolve(result).then(next, function(e) { fail(e); return next(); });
        }
        else s |= 1;
      }
      catch (e) {
        fail(e);
      }
    }
    if (s === 1) return env.hasError ? Promise.reject(env.error) : Promise.resolve();
    if (env.hasError) throw env.error;
  }
  return next();
}

function __rewriteRelativeImportExtension(path, preserveJsx) {
  if (typeof path === "string" && /^\.\.?\//.test(path)) {
      return path.replace(/\.(tsx)$|((?:\.d)?)((?:\.[^./]+?)?)\.([cm]?)ts$/i, function (m, tsx, d, ext, cm) {
          return tsx ? preserveJsx ? ".jsx" : ".js" : d && (!ext || !cm) ? m : (d + ext + "." + cm.toLowerCase() + "js");
      });
  }
  return path;
}

/* harmony default export */ const tslib_es6 = ({
  __extends,
  __assign,
  __rest: tslib_es6_rest,
  __decorate,
  __param,
  __esDecorate,
  __runInitializers,
  __propKey,
  __setFunctionName,
  __metadata,
  __awaiter: tslib_es6_awaiter,
  __generator,
  __createBinding,
  __exportStar,
  __values,
  __read,
  __spread,
  __spreadArrays,
  __spreadArray,
  __await,
  __asyncGenerator,
  __asyncDelegator,
  __asyncValues,
  __makeTemplateObject,
  __importStar,
  __importDefault,
  __classPrivateFieldGet,
  __classPrivateFieldSet,
  __classPrivateFieldIn,
  __addDisposableResource,
  __disposeResources,
  __rewriteRelativeImportExtension,
});

;// ./browser/consts.ts

const PAYMENT_METHODS_DICT = {
    'yandex-pay-and-split-card': PaymentMethodType.Card,
    'yandex-pay-and-split-split': PaymentMethodType.Split,
};
const ACTIVE_CONTAINER_CLASS = 'yandex-pay-and-split_button_container';
const consts_ACTIVE_CONTAINER_ID = 'yandex-pay-and-split-button-container';
const consts_WIDGET_CONTAINER_CLASS = 'yandex-pay-and-split_widget_container';
const consts_PRODUCT_DATA_CLASS = 'yandex_pay_product_data';

;// ./browser/lib/getters.ts


const getButtonContainer = () => ensure(document.querySelector(`#${ACTIVE_CONTAINER_ID}`), {
    message: "Button container wasn't found",
});
const getProduct = () => ensure_ensure(document.querySelector('.product'), {
    message: "Product wasn't found",
});
const getProductDataElement = () => ensure(getProduct().querySelector(`.${PRODUCT_DATA_CLASS}`), {
    message: "Product data wasn't found",
});
const findProductQuantities = () => getProduct().querySelectorAll('input.qty');
const findGroupedProductCheckboxes = () => getProduct().querySelectorAll('input.wc-grouped-product-add-to-cart-checkbox');
const getClosestProductContainer = (element) => ensure(element.closest('.product'), {
    message: "Product container wasn't found",
});
const getWidgetContainer = () => {
    var _a, _b;
    const productCartContainer = (_b = (_a = document
        .querySelector('input[name="payment_method"]:checked')) === null || _a === void 0 ? void 0 : _a.parentElement) === null || _b === void 0 ? void 0 : _b.querySelector(`.${WIDGET_CONTAINER_CLASS}`);
    const anyWidgetContainer = document.querySelector(`.${WIDGET_CONTAINER_CLASS}`);
    return ensure(productCartContainer !== null && productCartContainer !== void 0 ? productCartContainer : anyWidgetContainer, {
        message: "Widget container wasn't found",
    });
};
const getCurrentProductBadges = () => ensure_ensure(document.querySelectorAll('.single-product-badges yandex-pay-badge'), {
    message: "Product badges weren't found",
});
const getForm = () => {
    var _a;
    return ensure((_a = document.querySelector('.checkout.woocommerce-checkout')) !== null && _a !== void 0 ? _a : document.querySelector('.wc-block-components-form.wc-block-checkout__form'), {
        message: "Form wasn't found",
    });
};
const getInputProductId = (input) => {
    var _a;
    const productId = (_a = /quantity\[(\d+)\]/.exec(input.name)) === null || _a === void 0 ? void 0 : _a.at(1);
    return productId === undefined ? null : parseInt(productId);
};
const getProductQuantity = (input) => {
    let inputValue = input.value ? input.value : '0';
    if (input.getAttribute('type') === 'checkbox' && !input.checked) {
        inputValue = '0';
    }
    return parseInt(inputValue);
};

;// ./browser/single-product/render/badges.ts

const renderBadges = (totalAmount) => {
    for (const badge of getCurrentProductBadges()) {
        badge.setAttribute('amount', totalAmount.value.toString());
    }
};

;// ./browser/single-product/render/widgets.ts
let widgetMounted = false;
const renderWidget = () => {
    if (!widgetMounted) {
        widgetMounted = true;
        window.YaPayWC.mountWidget();
    }
};

;// ./browser/single-product/render/index.ts



const updateTotalAmount = (totalAmount) => tslib_es6_awaiter(void 0, void 0, void 0, function* () {
    try {
        yield window.YaPayWC.update({
            totalAmount: totalAmount.value.toString(),
        });
    }
    catch (err) {
        console.error(err);
        window.YaPayWC.unmount();
    }
});

;// ./browser/single-product/kind/any.ts






quantityState.subscribe((state) => {
    if (!priceState.hasValue()) {
        return;
    }
    let totalAmount = 0;
    for (const [productId, quantity] of state.value) {
        totalAmount += quantity * priceState.value().value.get(productId);
    }
    amountState.update(new Value(totalAmount));
});
priceState.subscribe((state) => {
    if (!quantityState.hasValue()) {
        return;
    }
    let totalAmount = 0;
    for (const [productId, price] of state.value) {
        totalAmount += quantityState.value().value.get(productId) * price;
    }
    amountState.update(new Value(totalAmount));
});
let defaultPrice = null;
variationState.subscribe((state) => {
    if (!priceState.hasValue()) {
        return;
    }
    let price;
    if (state.value === null) {
        if (defaultPrice === null) {
            defaultPrice = priceState.value().value.get(null);
        }
        price = defaultPrice;
    }
    else {
        price = priceState.value().value.get(state.value);
    }
    priceState.update(new Value(new Map([[null, price]])));
});
const init = ($) => {
    const productData = window.yandex_pay_and_split_product_data;
    const priceMap = new MapDefaultNumber();
    for (const [productId, price] of Object.entries(productData.prices)) {
        if (productId === 'default') {
            priceMap.set(null, price);
        }
        else {
            priceMap.set(parseInt(productId), price);
        }
    }
    priceState.set(new Value(priceMap));
    amountState.set(new ValueWithDefault(productData.prices.default, productData.prices.default));
    const initEvents = () => {
        amountState.subscribe(renderBadges);
        amountState.subscribe(renderWidget);
        amountState.subscribe(updateTotalAmount);
        amountState.trigger();
    };
    if (window.YaPay) {
        initEvents();
    }
    else {
        $(window).on('ya_pay_sdk_loaded', initEvents);
    }
};
const initQuantities = () => {
    const inputs = Array.from(findProductQuantities()).concat(Array.from(findGroupedProductCheckboxes()));
    const updateInput = (event) => {
        if (event.target === null || !(event.target instanceof HTMLInputElement)) {
            return;
        }
        quantityState.update(new Value(new Map([[getInputProductId(event.target), getProductQuantity(event.target)]])));
    };
    const defaultQuantity = new MapDefaultNumber();
    for (const productQuantityInput of inputs) {
        defaultQuantity.set(getInputProductId(productQuantityInput), getProductQuantity(productQuantityInput));
        productQuantityInput.addEventListener('change', debounce(updateInput, 500));
    }
    quantityState.set(new Value(defaultQuantity));
};

;// ./browser/single-product/kind/variable.ts



const variable_init = ($) => {
    if (getProduct().classList.contains('product-type-variable')) {
        $(document.body)
            .on('show_variation', (_, wcVariation) => {
            variationState.update(new Value(wcVariation.variation_id));
        })
            .on('hide_variation', () => {
            variationState.update(new Value(null));
        });
    }
    variationState.set(new Value(null));
};

;// ./browser/single-product/kind/index.ts



;// ./browser/single-product/index.ts



;// ./browser/ya-pay-variable-product-observer.ts


jQuery(sequence(init, initQuantities, variable_init));

/******/ })()
;