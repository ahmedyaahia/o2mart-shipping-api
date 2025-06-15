
## Endpoint

**POST** `/api/calculate-shipping`

### Sample Request

```json
{
  "monthly_shipments": 300,
  "destination_type": "remote",
  "weight": 10,
  "length": 40,
  "width": 30,
  "height": 25
}