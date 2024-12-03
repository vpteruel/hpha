-- qty per status
SELECT
    em.meta_value as status,
    COUNT(DISTINCT em.entry_id) AS entry_count
FROM wp_gf_entry_meta em
INNER JOIN wp_gf_entry e ON em.entry_id = e.id
WHERE
    e.form_id = 1
    AND e.status = 'active'
    AND em.meta_key = 'workflow_final_status'
GROUP BY em.meta_value
ORDER BY entry_count DESC;

-- qty per site
SELECT
    t.meta_value AS site,
    COUNT(DISTINCT t.entry_id) AS entry_count
FROM wp_gf_entry_meta t
WHERE
    t.form_id = 1
    AND t.meta_key = '89'
GROUP BY site
ORDER BY entry_count DESC;

-- total sum per site
SELECT
    em1.meta_value AS site,
    SUM(CAST(em2.meta_value AS DECIMAL(10, 2))) AS entry_sum
FROM wp_gf_entry_meta em1
JOIN wp_gf_entry_meta em2 ON em1.entry_id = em2.entry_id
WHERE
    em1.form_id = 1 AND em1.meta_key = '89'
    AND em2.form_id = 1 AND em2.meta_key = '4'
GROUP BY site
ORDER BY entry_sum DESC;

-- qty per type
SELECT
    t.meta_value AS type,
    COUNT(DISTINCT t.entry_id) AS entry_count
FROM wp_gf_entry_meta t
WHERE
    t.form_id = 1
    AND t.meta_key = '5'
GROUP BY t.meta_value
ORDER BY entry_count DESC;

-- qty per requester
SELECT
    u.email AS requester_email,
    COUNT(DISTINCT em.entry_id) AS entry_count
FROM wp_gf_entry_meta em
INNER JOIN hpha_users u ON em.meta_value = u.wp_user_id
WHERE 
    em.form_id = 1
    AND em.meta_key = '56'
GROUP BY u.email
ORDER BY entry_count DESC;

-- qty per department
SELECT
    em.meta_value AS department_code,
    d.name AS department_name,
    COUNT(DISTINCT em.entry_id) AS entry_count
FROM wp_gf_entry_meta em
INNER JOIN hpha_departments d
    ON CAST(em.meta_value AS CHAR) COLLATE utf8mb4_unicode_520_ci = d.function_centre_number COLLATE utf8mb4_unicode_520_ci
WHERE
    em.form_id = 1
    AND em.meta_key = '196'
GROUP BY department_code, department_name
ORDER BY entry_count DESC;

-- total sum per department
SELECT
    em1.meta_value AS department_code,
    d.name AS department_name,
    COUNT(DISTINCT em2.entry_id) AS entry_count,
    SUM(CAST(em2.meta_value AS DECIMAL(10, 2))) AS entry_sum
FROM wp_gf_entry_meta em1
JOIN wp_gf_entry_meta em2 ON em1.entry_id = em2.entry_id
INNER JOIN hpha_departments d
    ON CAST(em1.meta_value AS CHAR) COLLATE utf8mb4_unicode_520_ci = d.function_centre_number COLLATE utf8mb4_unicode_520_ci
WHERE
    em1.form_id = 1 AND em1.meta_key = '196'   -- department code
    AND em2.form_id = 1 AND em2.meta_key = '4' -- total sum
GROUP BY department_code, department_name
ORDER BY entry_sum DESC;

-- avg value per department
SELECT 
    em1.meta_value AS department_code,
    d.name AS department_name,
    COUNT(DISTINCT em2.entry_id) AS entry_count,
    AVG(CAST(em2.meta_value AS DECIMAL(10, 2))) AS entry_avg
FROM wp_gf_entry_meta em1
JOIN wp_gf_entry_meta em2 ON em1.entry_id = em2.entry_id
INNER JOIN hpha_departments d
    ON CAST(em1.meta_value AS CHAR) COLLATE utf8mb4_unicode_520_ci = d.function_centre_number COLLATE utf8mb4_unicode_520_ci
WHERE
    em1.form_id = 1 AND em1.meta_key = '196'   -- department code
    AND em2.form_id = 1 AND em2.meta_key = '4' -- total sum
GROUP BY department_code, department_name
ORDER BY entry_avg DESC;

-- count, sum, and avg value per department
SELECT 
    em1.meta_value AS department_code,
    d.name AS department_name,
    COUNT(DISTINCT em2.entry_id) AS entry_count,
    SUM(CAST(em2.meta_value AS DECIMAL(10, 2))) AS entry_sum,
    AVG(CAST(em2.meta_value AS DECIMAL(10, 2))) AS entry_avg
FROM wp_gf_entry_meta em1
JOIN wp_gf_entry_meta em2 ON em1.entry_id = em2.entry_id
INNER JOIN hpha_departments d
    ON CAST(em1.meta_value AS CHAR) COLLATE utf8mb4_unicode_520_ci = d.function_centre_number COLLATE utf8mb4_unicode_520_ci
WHERE
    em1.form_id = 1 AND em1.meta_key = '196'   -- department code
    AND em2.form_id = 1 AND em2.meta_key = '4' -- total sum
GROUP BY department_code, department_name
ORDER BY entry_count DESC;

-- qty per date
SELECT 
    DATE(FROM_UNIXTIME(em.meta_value)) AS submission_date,
    COUNT(DISTINCT em.entry_id) AS entry_count
FROM wp_gf_entry_meta em
WHERE em.meta_key = 'workflow_timestamp'
GROUP BY submission_date
ORDER BY submission_date DESC;