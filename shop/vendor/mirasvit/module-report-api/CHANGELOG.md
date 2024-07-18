## 1.0.67
*(2024-04-19)*

#### Fixed
* Fixed the issue with warning: Method 'Magento\Framework\DB\Select::group' expects parameter 1 ('spec') of type 'array|string', received '\Zend_Db_Expr' instead

---

## 1.0.66
*(2024-04-18)*

#### Fixed
* Fixed the issue with dashboard chart data for previous period (comparison)
* Fixed the issue with the data in multidimensional reports

---

## 1.0.65
*(2024-03-06)*

#### Fixed
* Fixed the issue with incorrect totals when report includes an aggregated column from the table different from the base table of the report

---

## 1.0.64
*(2023-12-04)*

#### Improvements
* Ability to enable/disable group reports data by dimension columns

---

## 1.0.63
*(2023-09-18)*

#### Fixed
* Fixed the issue with internal filters

---

## 1.0.62
*(2023-08-22)*

#### Fixed
* Fixed the issue with the error 'Illegal offset type' on reports related to custom attribute em_shipping_policy

---

## 1.0.61
*(2023-08-18)*

#### Fixed
* Fixed the issue with primary filters (in toolbar) not working properly in some reports

---

## 1.0.60
*(2023-06-14)*

#### Fixed
* Fixed the issue with Product Performance report

---

## 1.0.59
*(2023-06-02)*

#### Fixed
* Fixed the issue with filtering reports using 0 in filters (for example, from 0 to 0)

---

## 1.0.58
*(2023-02-06)*

#### Fixed
* Fixed the issue with the error 'Insert value list does not match column list' when the reports dimension is sales_order_item|item_id

---

### 1.0.57
*(2023-01-23)*

#### Improvements
* Support Magento 2.4.6


## 1.0.56
*(2022-12-28)*

#### Fixed
* Fixed the issue with incorrect data in some custom fields (related to configurable products)

---

## 1.0.55
*(2022-10-28)*

#### Fixed
* Fixed the issue with default currency in reports

---

## 1.0.54
*(2022-06-27)*

#### Fixed
* Reports configs loading order

---

## 1.0.53
*(2022-06-15)*

#### Fixed
* Fixed the issue with errors 'Invalid Document Element 'pk': This element is not expected'

---

## 1.0.52
*(2022-06-03)*

#### Fixed
* Fixed the issue with errors when tax filter applied ([#63]())

---

## 1.0.51
*(2022-05-10)*

#### Improvements
* upgrade for new magento api

---

## 1.0.49
*(2022-01-26)*

#### Fixed
* Compatibility with php8.1
* Issue with auto_increment field error

---

## 1.0.48
*(2022-01-21)*

#### Fixed
* Compatibility with php8.1

---

## 1.0.47
*(2022-01-13)*

#### Improvements
* Performance improvement

---

## 1.0.46
*(2021-10-18)*

#### Fixed
* issue with currency (store filter with multiple stores)

---

## 1.0.45
*(2021-08-26)*

#### Fixed
* fixed the issue with MySQL error after applying filter by entity_id column (pk)

---

## 1.0.44
*(2021-06-24)*

#### Fixed
* Display admin area attribute options labels in reports

---

## 1.0.43
*(2021-03-10)*

#### Fixed
* Fixed the issue with filtering by multiselect-type attributes [#47]()

---

## 1.0.42
*(2021-02-18)*

#### Fixed
* Fixed the issue related to WEEK aggregator [#45]()
* Fixed the issue with errors when custom customer attributes used in reports (Magento Enterprise Edition) [#44]()
* Fixed the issue with the error during the validation of the fields declaration in the config builder when the fild name includes numbers [#43]()

---

## 1.0.41
*(2020-10-07)*

#### Fixed
* Order item pills

---

## 1.0.40
*(2020-08-31)*

#### Fixed
* Fixed issue with split DB Magento EE ([#32]())

---

## 1.0.39
*(2020-07-29)*

#### Features
* Magento 2.4

#### Fixed
* issue with currencies (detected by tests)

---

## 1.0.38
*(2020-06-17)*

#### Fixed
* Issue with custom reports without dimensions (Undefined offset: 0 in .../Mirasvit/ReportApi/Service/ColumnService.php on line 84)
* Issue with week date aggregator

---

## 1.0.37
*(2020-04-14)*

#### Fixed
* Issue with no content in table widgets with custom daterange in dashboard (affects only 1.0.36)

---

## 1.0.36
*(2020-04-08)*

#### Fixed
* Issue with incorrect default currency in reports

---

## 1.0.35
*(2020-03-20)*

#### Fixed
* Issue type error on dashboard and reports pages (Type Error occurred when creating object: Mirasvit\ReportApi\Config\Loader\Data)

---

## 1.0.34
*(2020-03-02)*

#### Fixed
* Issue with too long tmp table name customer segment

---

## 1.0.33
*(2020-01-15)*

#### Improvements
* Display reports in the store default currency

---

## 1.0.32
*(2020-01-10)*

#### Improvements
* Performance

---

## 1.0.31
*(2020-01-08)*

#### Improvements
* Performance

---

## 1.0.30
*(2019-11-22)*

#### Fixed
* Issue with not displaying negative values in reports

---

## 1.0.29
*(2019-11-06)*

#### Fixed
* Issue with wrong join on Magento EE

---

## 1.0.27
*(2019-10-25)*

#### Fixed
* Issue with page size calculation due timezones

---

## 1.0.26
*(2019-08-30)*

#### Fixed
* Possible issue with loading of options 

---

## 1.0.25
*(2019-08-29)*

#### Improvements
* Cache attribute options for preventing slow initial loading

#### Fixed
* type in composer.json

---

## 1.0.24
*(2019-08-08)*

#### Fixed
* EQP

---

## 1.0.23
*(2019-04-11)*

#### Fixed
* Changed module to library

---

## 1.0.22
*(2019-01-25)*

#### Fixed
* Sales order item join strategy

---

## 1.0.21
*(2019-01-18)*

#### Fixed
* Issue with wrong results for Sales by Attribute report

---

## 1.0.20
*(2019-01-02)*

#### Fixed
* Issue with sorting reports

---

## 1.0.19
*(2018-12-22)*

#### Improvements
* Multi-dimmension select

---

## 1.0.18
*(2018-12-17)*

#### Improvements
* Relations API

---

## 1.0.17
*(2018-12-11)*

#### Improvements
* Response interface

#### Fixed
* Issue with temporary tables

---

## 1.0.16
*(2018-12-05)*

#### Fixed
* Issue with timeout

---

## 1.0.15
*(2018-12-04)*

#### Fixed
* API

---

## 1.0.14
*(2018-11-29)*

#### Fixed
* Compatibility with Magento 2.3

#### Improvements
* Multi-dimension queries
* Use field name as default label for column name


---

## 1.0.12
*(2018-09-28)*

#### Improvements
* Ability to provide patches for creating the temporary tables

---

## 1.0.11
*(2018-09-26)*

#### Improvements
* Groups, Labels

---

## 1.0.10
*(2018-09-25)*

#### Improvements
* new column type 'serialized'

---

## 1.0.9
*(2018-09-21)*

#### Fixed
* Cannot create custom reports in some cases: due to deep level of relations

---

## 1.0.8
*(2018-09-05)*

#### Fixed
* Timezone is not applied in some reports, due to this some values are wrong
* Correctly show customer EAV attributes
* Reports are not displayed when attributes with absent source model exist

---

## 1.0.7
*(2018-08-17)*

#### Fixed
* 'Sales by Day of Week' report assigns wrong weekday name to a date

---

## 1.0.6
*(2018-08-03)*

#### Improvements
* Ability to count columns of type QTY

---

## 1.0.5
*(2018-08-03)*

#### Improvements
* Ability to count columns of type String

---

## 1.0.4
*(2018-07-30)*

#### Fixed
* Count only distinct values

---

## 1.0.3
*(2018-07-30)*

#### Improvements
* API method to check whether the column is filter only

---

## 1.0.2
*(2018-07-24)*

#### Fixed
* Filter is not applied in some cases

---

## 1.0.1
*(2018-07-23)*

#### Improvements
* Translate column's names

---
