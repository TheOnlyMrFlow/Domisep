DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_history` ON SCHEDULE EVERY 1 MINUTE STARTS '2019-01-23 00:00:00' ENDS '2019-01-26 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO values_history(
    values_history.timestamp,
    values_history.serial_number,
    values_history.value
)
SELECT
    CURRENT_TIMESTAMP,
    components.serial_number,
    components.value
FROM
    components
WHERE
    (
        components.serial_number LIKE 'sma%' OR components.serial_number LIKE 'sen%'
    )$$

CREATE DEFINER=`root`@`localhost` EVENT `update_tasks` ON SCHEDULE EVERY 10 SECOND STARTS '2019-01-21 23:35:06' ENDS '2019-01-26 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE
        components AS c1
    INNER JOIN preset_values AS pv1
    ON
        pv1.serial_number = c1.serial_number
    INNER JOIN tasks AS t1
    ON
        t1.id_preset = pv1.id_preset
    SET
        c1.value = pv1.value,
        c1.state = pv1.on_off
    WHERE
        t1.start_date <= CURRENT_DATE AND t1.hour <= CURRENT_TIME AND t1.on_off=1;
        
    UPDATE
        tasks
    SET
        tasks.start_date = DATE_ADD(
            tasks.start_date,
            INTERVAL tasks.frequency SECOND
        )
    WHERE
        tasks.start_date <= CURRENT_DATE AND tasks.hour <= CURRENT_TIME AND tasks.on_off=1 ;
END$$

DELIMITER ;