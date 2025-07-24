# Diamond Attributes Documentation

This document describes the attributes used for representing a diamond, including possible values and formats.

## Attributes

### `diamond_id`
- **Type**: UUID (GUID)
- **Description**: A unique identifier for each diamond.
- **Example**: `a3c91e8b-4b7f-4e2c-bd7e-fc3ab89a932f`

---

### `supplier_name`
- **Type**: String
- **Description**: Name of the supplier providing the diamond.
- **Possible Values**:
  - `GemWorld`
  - `DiamondHub`
  - `SparkleSource`
  - `ShinyGems`
  - `LuxeStones`

---

### `shape`
- **Type**: String
- **Description**: The shape or cut style of the diamond.
- **Possible Values**:
  - `Round`
  - `Princess`
  - `Oval`
  - `Cushion`
  - `Emerald`
  - `Pear`
  - `Marquise`
  - `Radiant`

---

### `size`
- **Type**: Float (in carats)
- **Description**: The carat weight of the diamond.
- **Range**: `0.3` to `5.0`

---

### `color`
- **Type**: String
- **Description**: The color grade of the diamond, from colorless to near-colorless.
- **Possible Values**:
  - `D`, `E`, `F`, `G`, `H`, `I`, `J`

---

### `clarity`
- **Type**: String
- **Description**: The clarity grade, indicating the presence of inclusions.
- **Possible Values**:
  - `IF` (Internally Flawless)
  - `VVS1`, `VVS2` (Very, Very Slightly Included)
  - `VS1`, `VS2` (Very Slightly Included)
  - `SI1`, `SI2` (Slightly Included)

---

### `cut`
- **Type**: String
- **Description**: The cut grade, assessing the diamond's proportions and finish.
- **Possible Values**:
  - `Excellent`
  - `Very Good`
  - `Good`

---

### `symmetry`
- **Type**: String
- **Description**: Describes the symmetrical aspects of the diamond's cut.
- **Possible Values**:
  - `Excellent`
  - `Very Good`
  - `Good`

---

### `polish`
- **Type**: String
- **Description**: Refers to the smoothness of the diamond's surface.
- **Possible Values**:
  - `Excellent`
  - `Very Good`
  - `Good`

---

### `lab`
- **Type**: String
- **Description**: The gemological laboratory that issued the certificate.
- **Possible Values**:
  - `GIA` (Gemological Institute of America)
  - `HRD` (Hoge Raad voor Diamant)

---

### `certification_number`
- **Type**: String (Numeric)
- **Description**: Unique number assigned to the diamond's certificate.
- **Example**: `82345678`

---

### `certificate_url`
- **Type**: URL
- **Description**: A direct link to view or download the certification document.
- **Format**: `https://certificates.example.com/{certification_number}`

---

### `location`
- **Type**: String
- **Description**: The current physical location of the diamond.
- **Possible Values**:
  - `Bangkok`
  - `Hong Kong`
  - `India`

---

### `price_usd`
- **Type**: Float
- **Description**: The selling price of the diamond in US Dollars.
- **Range**: `$1,000.00` to `$50,000.00`

---
