-- 1,2,3,4,7,8,10,12,13,32

UPDATE properties 
SET city_id = 1369
WHERE property_id IN (1, 3, 7, 10, 13)

UPDATE properties 
SET city_id = 1371
WHERE property_id IN (2, 4, 8, 12, 32)

UPDATE pro
SET pro.selling_type_id = prst.selling_type_id
FROM property_owned pro
INNER JOIN property_selling_types prst ON pro.property_selling_type_id = prst.property_selling_type_id