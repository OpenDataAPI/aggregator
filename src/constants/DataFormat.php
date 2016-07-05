<?php

namespace OpenDataAPI\aggregator\constants;

/**
 * Supported data formats.
 *
 * Формати даних які затверджені для оприлюднення наборів даних згідно положення
 * про набори даних, які підлягають оприлюдненню у формі відкритих даних.
 *
 * @category Open Data APIs Aggregator
 * @author Dmytro Zarezenko <dmytro.zarezenko@gmail.com>
 * @copyright (c) 2016, Dmytro Zarezenko
 *
 * @git https://github.com/OpenDataAPI/aggregator
 * @license http://opensource.org/licenses/MIT
 */
class DataFormat {

    /**
     * Text data
     */
    const TXT = 'txt';
    const RTF = 'rtf';
    const ODT = 'odt';
    const DOC = 'doc';
    const DOCX = 'docx';
    const PDF = 'pdf';
    const HTML = 'html';

    /**
     * Semi-structured data
     */
    const XLS = 'xls';
    const XLSX = 'xlsx';
    const ODS = 'ods';

    /**
     * Structured data
     */
    const RDF = 'rdf';
    const XML = 'xml';
    const JSON = 'json';
    const CSV = 'csv';
    const YAML = 'yaml';
    const KML = 'kml';

    /**
     * Graphical data
     */
    const GIF = 'gif';
    const TIFF = 'tiff';
    const JPG = 'jpg';
    const JPEG = 'jpeg';
    const PNG = 'png';
    const BMP = 'bmp';

    /**
     * Audio data
     */
    const MP3 = 'mp3';
    const WAV = 'wav';
    const MKA = 'mka';

    /**
     * Video data
     */
    const MPEG = 'mpeg';
    const MKV = 'mkv';
    const AVI = 'avi';
    //const FLV = 'flv';
    const MKS = 'mks';
    const MK3D = 'mk3d';

    /**
     * Flash
     */
    const SWF = 'swf';
    const FLV = 'flv';

    /**
     * Archived data
     */
    const ZIP = 'zip';
    const _7Z = '7z';
    const GZIP = 'gzip';
    const BZIP = 'bzip';
    const BZIP2 = 'bzip2';
    const TAR = 'tar';
    const RAR = 'rar';

}
